// store/index.js
import Vue from 'vue';
import Vuex from 'vuex';

import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        token: null,
        error: null,
        vinCode: null,
        vinData: null,
    },
    plugins: [createPersistedState()],
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_ERROR(state, error) {
            state.error = error;
        },
        SET_VIN_CODE(state, token) {
            state.vinCode = token;
        },
        SET_VIN_DATA(state, error) {
            state.vinData = error;
        },
        CLEAR_USER(state) {
            state.user = null;
        },
        CLEAR_TOKEN(state) {
            state.token = null;
        },
    },
    actions: {
        async registerUser({ commit }, userData) {
            try {
                const response = await fetch(`/api/auth/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(userData),
                });
                if (response.ok) {
                    const data = await response.json();
                    commit('SET_USER', data.user);
                } else {
                    throw new Error('Failed to register user.');
                }
            } catch (error) {
                commit('SET_ERROR', error.message);
            }
        },
        async validatePhoneCode({ commit }, phoneData) {
            try {
                const response = await fetch(`/api/auth/validate-phone-code`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(phoneData),
                });
                if (response.ok) {
                    const data = await response.json();
                    if (data.is_validated) {
                        commit('SET_USER', data.user);
                        commit('SET_TOKEN', data.token);
                        return true;
                    } else {
                        throw new Error('Failed to validate phone code');
                    }
                } else {
                    throw new Error('Failed to validate phone code');
                }
            } catch (error) {
                console.error('Error validating phone code:', error);
                return false; // Return false to indicate failed validation
            }
        },
        async logout({ commit, state }) {
            try {
                const response = await fetch(`/api/auth/logout`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${state.token}`
                    }
                });

                commit('CLEAR_USER');
                commit('CLEAR_TOKEN');

            } catch (error) {
                console.error('Error logging out:', error);
            }
        },
        async loginUser({ commit }, credentials) {
            try {
                const response = await fetch(`/api/auth/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(credentials),
                });
                if (response.ok) {
                    const data = await response.json();
                    commit('SET_USER', data.user);
                    commit('SET_TOKEN', data.token);

                    console.log(data.user);
                } else {
                    throw new Error('Failed to login.');
                }
            } catch (error) {
                commit('SET_ERROR', error.message);
                throw error;
            }
        },
        async sendPhoneCode({ commit, state }, phoneData) {
            try {
                const response = await fetch(`/api/auth/send-phone-code`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(phoneData),
                });
                const data = await response.json();
                if (response.ok) {
                    commit('SET_USER', data.user);
                } else {
                    throw new Error('Failed to send phone code');
                }
            } catch (error) {
                console.error('Error sending phone code:', error);
            }
        },
        async validateVin({ commit, state }, vinData) {
            try {
                commit('SET_VIN_CODE', vinData.vin_code);

                const response = await fetch(`/api/vin/validate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${state.token}`
                    },
                    body: JSON.stringify(vinData),
                });
                if (response.ok) {
                    const data = await response.json();
                    commit('SET_VIN_DATA', data);

                } else {
                    throw new Error('Failed to validate VIN.');
                }
            } catch (error) {
                console.error('Error validating VIN:', error);
                // Aquí podrías manejar el error, como mostrar un mensaje al usuario
            }
        }
    },
});

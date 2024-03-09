<?php

namespace Services\Telesing;

interface TelesignContract
{
    /**
     * Envía un código de verificación a un número de teléfono.
     *
     * @param int $phoneNumber El número de teléfono al que enviar el código.
     * @param int $verifyCode El código de verificación a enviar.
     * @return array La respuesta de la API.
     */
    public function sendVerificationCode(int $phoneNumber, int $verifyCode): array;

    /**
     * Valida un código de verificación enviado a un número de teléfono.
     *
     * @param string $verificationId El ID de verificación asociado al número de teléfono.
     * @param int $verifyCode El código de verificación a validar.
     * @return array La respuesta de la API.
     */
    public function validateVerificationCode(string $verificationId, int $verifyCode): array;
}

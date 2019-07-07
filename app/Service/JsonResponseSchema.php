<?php

namespace App\Service;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class JsonResponseSchema
{
    /**
     * Http Status.
     *
     * https://github.com/symfony/http-foundation/blob/master/Response.php
     */
    private $httpStatus = [
        'unauthorized'    => Response::HTTP_UNAUTHORIZED,
        'internal_error'  => Response::HTTP_INTERNAL_SERVER_ERROR,
        'ok'              => Response::HTTP_OK,
        'created'         => Response::HTTP_CREATED,
        'no_content'      => Response::HTTP_NO_CONTENT,
        'not_found'       => Response::HTTP_NOT_FOUND,
        'validate_fail'   => Response::HTTP_UNPROCESSABLE_ENTITY,
        'too_many_attemp' => Response::HTTP_TOO_MANY_REQUESTS,
    ];

    private $message = null;

    private $statusCode;

    private $responseData;

    private $isRefreshToken;

    /**
     * Set response message.
     *
     * @param string $message response message
     *
     * @return App\Response\AppResponse
     */
    public function message(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set response status.
     *
     * @param string $statusAlias http status alias
     *
     * @return App\Response\AppResponse
     */
    public function status(string $statusAlias)
    {
        $this->statusCode = is_numeric($statusAlias) ? $this->numericStatus($statusAlias) : $this->stringStatus($statusAlias);

        return $this;
    }

    /**
     * Get numerice status.
     *
     * @param int $statusCode
     *
     * @return int
     */
    public function numericStatus(int $statusCode)
    {
        $this->httpStatus = array_flip($this->httpStatus);

        if (!array_key_exists($statusCode, $this->httpStatus)) {
            $statusCode = 500;
        }

        $statusAlias = $this->httpStatus[$statusCode];

        $this->httpStatus = array_flip($this->httpStatus);

        return $this->httpStatus[$statusAlias];
    }

    /**
     * Get string status.
     *
     * @param string $statusAlias
     *
     * @return string
     */
    public function stringStatus(string $statusAlias)
    {
        if (!array_key_exists($statusAlias, $this->httpStatus)) {
            $statusAlias = 'internal_error';
        }

        return $this->httpStatus[$statusAlias];
    }

    /**
     * Set response data.
     *
     * @param mixed $responseData response data
     *
     * @return App\Response\AppResponse
     */
    public function data($responseData)
    {
        $this->responseData = $responseData;

        return $this;
    }

    /**
     * Send response data.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function send()
    {
        $response = [
            'data'        => $this->responseData,
            'status_code' => $this->statusCode,
        ];

        if (!empty($this->message)) {
            $response['message'] = $this->message;
        }

        return new JsonResponse($response, $this->statusCode);
    }
}

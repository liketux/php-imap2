<?php

/*
 * This file is part of the PHP IMAP2 package.
 *
 * (c) Francesco Bianco <bianco@javanile.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Javanile\Imap2;

use stdClass;
use ZBateson\MailMimeParser\Message;
use ZBateson\MailMimeParser\Header\HeaderConsts;

class Polyfill
{
    public static function convert8bit($string)
    {
        return $string;
    }

    public static function base64($string)
    {
        return base64_decode($string);
    }

    public static function mimeHeaderDecode($string)
    {
        $element = new stdClass();
        $element->charset = 'utf8';
        $element->encoding = '';
        $element->text = $string;
        return[ $element ];

        /*$decodedText = '';
        $elements = [];

        $parts = preg_split('/\?/', $string);
        $numParts = count($parts);

        for ($i = 0; $i < $numParts; $i += 4) {
            $charset = $parts[$i + 1];
            $encoding = $parts[$i + 2];
            $string = $parts[$i + 3];

            if ($charset == 'default') {
                $charset = 'ISO-8859-1'; // Установите кодировку по умолчанию
            }

            if ($encoding == 'B') {
                // Декодируем строку, если кодировка - base64
                $decodedText .= base64_decode($string);
            } elseif ($encoding == 'Q') {
                // Декодируем строку, если кодировка - quoted-printable
                $decodedText .= quoted_printable_decode(str_replace('_', ' ', $string));
            }

            if ($i < $numParts - 4) {
                // Создаем объект и добавляем его в массив
                $element = new stdClass();
                $element->charset = $charset;
                $element->encoding = $encoding;
                $element->text = $decodedText;
                $elements[] = $element;

                // Сбрасываем значение decodedText
                $decodedText = '';
            }
        }

        return $elements;*/
    }

    public static function mutf7ToUtf8($string)
    {
        return $string;
    }

    public static function qPrint($string)
    {
        return $string;
    }

    public static function rfc822ParseAdrList($string, $defaultHost)
    {
        $message = Message::from('To: '.$string, false);

        return Functions::getAddressObjectList(
            $message->getHeader(HeaderConsts::TO)->getAddresses(),
            $defaultHost
        );
    }

    /**
     *
     * @param $headers
     * @param $defaultHostname
     *
     * @return mixed
     */
    public static function rfc822ParseHeaders($headers, $defaultHost = 'UNKNOWN')
    {
        $message = Message::from($headers, false);

        $date = $message->getHeaderValue(HeaderConsts::DATE);
        $subject = $message->getHeaderValue(HeaderConsts::SUBJECT);

        $hasReplyTo = $message->getHeader(HeaderConsts::REPLY_TO) !== null;
        $hasSender = $message->getHeader(HeaderConsts::SENDER) !== null;
        $hasTo = $message->getHeader(HeaderConsts::TO) !== null;

        return (object) [
            'date' => $date,
            'Date' => $date,
            'subject' => $subject,
            'Subject' => $subject,
            'message_id' => '<'.$message->getHeaderValue(HeaderConsts::MESSAGE_ID).'>',
            'toaddress' => $message->getHeaderValue($hasTo ? HeaderConsts::TO : HeaderConsts::FROM),
            'to' => Functions::getAddressObjectList($message->getHeader($hasTo ? HeaderConsts::TO : HeaderConsts::FROM)->getAddresses()),
            'fromaddress' => $message->getHeaderValue(HeaderConsts::FROM),
            'from' => Functions::getAddressObjectList($message->getHeader(HeaderConsts::FROM)->getAddresses()),
            'reply_toaddress' => $message->getHeaderValue($hasReplyTo ? HeaderConsts::REPLY_TO : HeaderConsts::FROM),
            'reply_to' => Functions::getAddressObjectList($message->getHeader($hasReplyTo ? HeaderConsts::REPLY_TO : HeaderConsts::FROM)->getAddresses()),
            'senderaddress' => $message->getHeaderValue($hasSender ? HeaderConsts::SENDER : HeaderConsts::FROM),
            'sender' => Functions::getAddressObjectList($message->getHeader($hasSender ? HeaderConsts::SENDER : HeaderConsts::FROM)->getAddresses()),
        ];
    }

    public static function rfc822WriteHeaders($mailbox, $hostname, $personal)
    {
        $ret = $mailbox;
        if (!empty($hostname))
        {
            $ret .= '@' . $hostname;
        }
        if (!empty($personal))
        {
            $ret .= ' <' . $personal . '>';
        }
        return $ret;
    }

    public static function utf7Decode($string)
    {
        return mb_convert_decoding($string, "UTF7-IMAP", "UTF-8");
    }

    public static function utf7Encode($string)
    {
        return mb_convert_encoding($string, "UTF-8", "UTF7-IMAP");
    }

    public static function utf8ToMutf7($string)
    {
        return $string;
    }

    public static function utf8($string)
    {
        return $string;
    }

    public static function mailCompose($envelope, $bodies)
    {
        return false;
    }
}

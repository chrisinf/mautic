<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'services' => [
        'events' => [
            'global_email_listener' => [
                'class' => 'Mautic\CustomBundle\EventListener\GlobalEmailListener',
                'arguments' => '@logger',
                'tags' => [
                    'swiftmailer.default.plugin'
                ]
            ]
        ],
        'other' => [
            'mautic.helper.update' => [
                'class'     => 'Mautic\CustomBundle\Helper\CustomUpdateHelper',
                'arguments' => 'mautic.factory',
            ],
        ],
    ],

    'models' => [
        'mautic.custom.model.emaillog' => [
            'class' => 'Mautic\CustomBundle\Model\EmailLogModel',
        ],
    ],

    'parameters' => [
        'update_stability'          => 'stable',
        'update_checkupdates_url'   => 'https://updates.mautic.org/index.php?option=com_mauticdownload&task=checkUpdates',
    ],
];

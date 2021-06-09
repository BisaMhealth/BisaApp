<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'firebase' => [
        'database_url' => env('FIREBASE_DATABASE_URL', ''),
        'project_id' => env('FIREBASE_PROJECT_ID', 'bisa-health--app'),
        'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID', 'c771a939334497f6d90d3d4aadbbadc34afe46fc'),
        // replacement needed to get a multiline private key from .env
        'private_key' => str_replace("\\n", "\n", env('FIREBASE_PRIVATE_KEY','-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDN+KHNizJOLTYE\nPlXZDOZ0BHOSHT6/VDJhMQoxztyi1HdtXgnHdwXpwziwFq5mpGNiMjYiKsD3oYdu\nEieBTkNQxMxOY1QKKs3yB8Bj6Gw+D4eBO16kUbZtTluRKDCN8bi7c2e/OG4ZfNrI\n4edwpJdlxlh5ePpdGSNnN/Yi3eXMDw3krE+dW29gZyEY0LAeXYUKbRNgMi0IfUi1\nM9j3VK4u3QVKhwENZtAbf4B0gTmrWS255xyQatmtpfY0uj0ytcSvOU6FQS8S7OYC\n1A7O5vWxdcIKn+R3z3iBqh0bHmyh/74fJh4hAE6w3g73q/HAc1KK596K5u3uzPYY\nOOwB5jVLAgMBAAECggEAV76Wt2iYKqOqAk7H5apQNpZ64YEh7QIiYDMzA5r7dUaM\nBgRsqBO1aitnZ+SRsVpQmFGJrC6IfDXM6wBC4hwEI1FjM/WupJItn/DbbfRiwGF/\nOXegTuIclB4wdfsoDCAwsXJtfRG+HY+J6NAL93m2oX3IzR7TkXuXEG7PpXTgY3g2\nq+MHoGelPs+6wzcUx82twgs4h+0Z6kuCh+hNE6LWkUIsKA59nWYJVdUqx9Kpy+kh\nKFrCO47/foeR+nFlWtnWUldnIJ01cydaDwQoWMSg0dvpuYrHyR7fMyeQe7um1tEO\n7Qxwpi96ZK78BhNQX3m6fxOzFdTslcobUoxfY159UQKBgQDn6KzYLzTAeUBY1cP7\nINBROsBoV6bMQO3OuxUpXt+4vsEvTTnpyQNLa2Wi8n0Jay3QhniFssvToK1T+uho\n/MfF6DRkh1i1kVNv/8ykxZhaJp4GSFPyHPb+2zh+AQq+jWq+PNYYAKGML+CfmV3p\n3PpQljw3YwRJIZs4x+AU+BZtwwKBgQDjXi1fd3lPzZZlWi932ZzQDQbqxLZ1Dv7G\nqnnk17xNyLcBbDecK1BNPej8oPyJGMKTYzSKr5Rgo6tggj7DWI0u7JkM3zvCcgNp\nSAbOQiX2p29vfjfx/S756UgYv9SgRrPryv3SvEkBM9872FZHdjpMabTr9T4kJge0\nvl+NdNZ52QKBgQCQRozhodyrscN6gOMAJRX0sxxozb8Ta4GHD5TGvCNrCCGfj+fr\nrgbCsPn2Oe3YIjnKdR4d73InItsyV/Km/jw6v494y0tBCjxifT2PdO6nh0bgmba/\n9Y0kWLX4jiVlDw3NdIOtQxc947tXD08B41xHLnAf9RYBeUrcNF0QLpeliQKBgGJz\nsz31Y+g0Y307kfZZmldUbLxXtZH2jkfEJcf7yqP715KcI3BSKRFpT2uk4fUTbZ2Y\nhXXQFXXLKTg+7aJ0w52gAZ3bQ+ssp2F9OMUzS3EEi3JBu0Pjl+XLJ9bfqdhFBT+C\nxGnt8ca9iVpGkQWcoh3YX+kUZnYMqaWQEZwVDZHxAoGAdpcEjs5Oduq2isZyvYTJ\n6+3ZUXqgQG38kalOjiDcywhkBWvZD4f8HLpm3QXm8JfNDBAYEcmu1yl050X1DVTQ\nP6RO3kjkOm8l9bRvsEjK6kBCzciJQ2ZPUCLhPw1CUr3xNd1HKIUvIo0wQB6csWBV\nVvR1HiMq+ILCep0aRbbaG54=\n-----END PRIVATE KEY-----\n')),
        'client_email' => env('FIREBASE_CLIENT_EMAIL', 'firebase-adminsdk-thbfp@bisa-health--app.iam.gserviceaccount.com'),
        'client_id' => env('FIREBASE_CLIENT_ID', '104580184142947141349'),
        'client_x509_cert_url' => env('FIREBASE_CLIENT_x509_CERT_URL', 'https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-thbfp%40bisa-health--app.iam.gserviceaccount.com'),
    ],

    // 'firebase' => [
    //     'database_url' => env('FIREBASE_DATABASE_URL', ''),
    //     'project_id' => env('FIREBASE_PROJECT_ID', 'bisa-gh'),
    //     'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID', 'c98a6fda587b4d488dd1b6ec8fe86b097d98f5cb'),
    //     // replacement needed to get a multiline private key from .env
    //     'private_key' => str_replace("\\n", "\n", env('FIREBASE_PRIVATE_KEY','-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC9QeTlDXNWEdkB\n7i0yqhFKu7hdf8y8s4AUKogxqfjHGxviHFmdH5aKwcr2P21oZ2R9XQ6Tjb2PWsPh\nPYwKTR0l7V7wME1JF/hDbQqHw65UMMF006XegcecE4xnxR1VH409oOZYiW7rBX0C\nhfRq8Q0fxqnxqn6NzsDV1M2TCPyGEiIJ7HwdP5HKyFI7tmB9ohBp7yIPOio8cfAY\n5TkeTwVEeyIdQQDAy6DRzVBoSYDBqBxA3Iguv/gUCz+hMY3idDNapfdO204BtTq2\nSx+28qjcVe5xKuuVxiBmTtXLE1yaFJAN/nbJYAQxp3tifVuZMddcNu46pwA1rsX6\ncpARMLVFAgMBAAECggEAFAvNuzaQgouuE6vvB6XHN8Y9wfw5Fb0MPOvrCcT6KoTE\nOvqhF1PINfb5kNmpCgehjOcgFcr2oB+PYzqKAcanPA7cy84h8YhjbdONQPzIvfbS\nwZVwGpWz1zlO2ZL3B2l/JAmjPGTaOx9ACCtjdzcEb9rdbKaQHw8ePR1Rj63CVE+a\nVXvibcCCCH0qL8UZXnONMLT+e/xBw95RazLMXAVMrdPIgggPFs6gUbAeiltvBN87\nqB92Q06ajpBweQrH++QxgUISgI4mOa1Nvsdt2Ok1AvtHz2b7JvHGYqDWglJNOl99\nVCe3pJbOI0mN0Em+oEBVfJlmLTpNOZ84tCMXKnJoxQKBgQD7llcOZ3XVe99WVFmD\nBmJwtq6C90eKFcQi9hqAJOVuAmypud/9Rn8FdR3fHtYQGxZOcPR8U8ZzlzQyW4z2\nUUB8Vxics4sS/24/kky+8Eu/4E2RQuiY08II6pd3cLDgxaDcAKrsVrKNUeMxNRuZ\nR+eY0QmYk+Ex7hdvK5j4KOlCVwKBgQDAk69Ly4laa3vcBLIGerGH6ooHF6Zk5QT1\ntUQrFXPwtXt1jiyd4be/Tqe9Hdx4GeeZ72inIr7ipSxZ3R6DItqv8Otd4Mf/Bp8q\nyO8ARr3/wZ5FgQKpkr14FBQpqOTtnOLXoOnURJZTrRHhAUEZlcmiGBt4DGre4+Q0\n/UBD1BwbwwKBgQCUfaqKVORGiaNLF+PxIp6NejVMFVlDFg+6ttjzU1Oa95FdJ9kd\nazNjbDmiTFf6D5K934tdqjCSXucu5bwwUcqm2N0s+AeYwew3V0k21StQZ7pAh2Yz\ndaCrlJKrq3aqY9rKnxZDAfTG1lMq4vaUJM17870fMgETcDyin+/cYIE0ZwKBgHa+\n2hmXkMNjgYVik8+w+iU/9wp2h9Cw80T7F+SlHs+vaEhNea+EzkO1oXLYpeicuJXP\n7S0aHLAuf1GOKlFcPZK9sLQ7dbcIgz7jlZQLCv9YiVp8OYMMi64uW1xw23C1C59A\nhs6v2C4SivK+TkETfrhnuxBkP8XeqgoOmwD4Grj3AoGBAO1G3+Jb7mk4IslxPak4\nMo+WnPzysvQeW66oZngMjy3pwl5a8LnS6yZ03IvyQJJu3i3hTSyirK+Z2r+5iU7h\nc41D/JcBKxgzPTtRlfgJw2qorpE01qBLpGvfD1lS4fDwFvq/TEG0zYIJKsRK0SZc\nQqLpWSamQ7tVqiFYJYJi7plR\n-----END PRIVATE KEY-----\n')),
    //     'client_email' => env('FIREBASE_CLIENT_EMAIL', 'firebase-adminsdk-326hf@bisa-gh.iam.gserviceaccount.com'),
    //     'client_id' => env('FIREBASE_CLIENT_ID', '108866149467713844624'),
    //     'client_x509_cert_url' => env('FIREBASE_CLIENT_x509_CERT_URL', 'https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-326hf%40bisa-gh.iam.gserviceaccount.com'),
    // ],





];

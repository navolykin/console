<?php

include './vendor/autoload.php';

Console\Console::getInstance('message')->color('red')->bold()->pale()->writeln(
    'Банальные, но неопровержимые выводы, а также тщательные исследования конкурентов ассоциативно распределены по отраслям. 
    Лишь стремящиеся вытеснить традиционное производство, нанотехнологии, 
    превозмогая сложившуюся непростую экономическую ситуацию, объединены в целые кластеры себе подобных. 
    Задача организации, в особенности же высококачественный прототип будущего проекта играет определяющее значение 
    для существующих финансовых и административных условий.'
);

Console\Console::getInstance('message', '', 'yellow', 'blue')->writeln(
    'Банальные, но неопровержимые выводы, а также тщательные исследования конкурентов ассоциативно распределены по отраслям. 
    Лишь стремящиеся вытеснить традиционное производство, нанотехнологии, 
    превозмогая сложившуюся непростую экономическую ситуацию, объединены в целые кластеры себе подобных. 
    Задача организации, в особенности же высококачественный прототип будущего проекта играет определяющее значение 
    для существующих финансовых и административных условий.'
);


Console\Console::getInstance('list')->content(
    [
        Console\Console::getInstance('message')->setStyle(new Console\Styles\ErrorStyle())->get('Error') =>
            Console\Console::getInstance('message')->setStyle(new Console\Styles\ErrorTextStyle())->get(' Этот лейбл может использоваться для отображения ошибки'),
        Console\Console::getInstance('message')->setStyle(new Console\Styles\WarningStyle())->get('Warning') =>
            Console\Console::getInstance('message')->setStyle(new Console\Styles\WarningTextStyle())->get(' Этот лейбл может использоваться для отображения предупреждения'),
        Console\Console::getInstance('message')->setStyle(new Console\Styles\SuccessStyle())->get('Success') =>
            Console\Console::getInstance('message')->setStyle(new Console\Styles\SuccessTextStyle())->get(' Этот лейбл может использоваться для отображения удачного действия'),
    ]
)->left()->writeln('');


Console\Helpers\error_text('Текст ошибки', true);
Console\Helpers\info('информация', true);


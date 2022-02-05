<?php

include './vendor/autoload.php';

Console\Console::getInstance('message')->color('red')->bg('green')->italic()->writeln(
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

$params = [
    'content' => 'dfsdfsfsdfsdfsdf',
    'color' => 'blue',
    'bg' => 'red',
];
Console\Console::getInstance('message', $params)->writeln('');

Console\Console::getInstance('message')->setStyle(new Console\Styles\ErrorStyle())->write('Error');
Console\Console::getInstance('message')->writeln(' - Этот лейбл может использоваться для отображения ошибки');

Console\Console::getInstance('message')->setStyle(new Console\Styles\WarningStyle())->write('Warning');
Console\Console::getInstance('message')->writeln(' - Этот лейбл может использоваться для отображения предупреждения');

Console\Console::getInstance('message')->setStyle(new Console\Styles\SuccessStyle())->write('Success');
Console\Console::getInstance('message')->writeln(' - Этот лейбл может использоваться для отображения удачного действия');

Console\Console::getInstance('list')->content(
        [
            Console\Console::getInstance('message')->bg('red')->color('black')->bold()->get('100') => 'гнорировать этот ответ, если запрос был завершён.', 
            Console\Console::getInstance('message')->bg('red')->color('black')->bold()->get('101') => 'fdfsdfsdfsdfsdfsf',
            Console\Console::getInstance('message')->bg('red')->color('black')->bold()->get('10sdfsdf2') => '"В обработке"',
            '404' => 'Нет страницы',
        ]
)->left()->writeln('');

Console\Console::getInstance('list')->content(
    [
        Console\Console::getInstance('message')->setStyle(new Console\Styles\ErrorStyle())->get('Error') => ' Этот лейбл может использоваться для отображения ошибки',
        Console\Console::getInstance('message')->setStyle(new Console\Styles\WarningStyle())->get('Warning') => ' Этот лейбл может использоваться для отображения предупреждения',
        Console\Console::getInstance('message')->setStyle(new Console\Styles\SuccessStyle())->get('Success') => ' Этот лейбл может использоваться для отображения удачного действия',
    ]
)->left()->writeln('');


Console\Helpers\error_text('Текст ошибки', true);
Console\Helpers\info('информация', true);

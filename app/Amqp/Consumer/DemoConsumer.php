<?php

// declare(strict_types=1);

// namespace App\Amqp\Consumer;

// use Hyperf\Amqp\Result;
// use Hyperf\Amqp\Annotation\Consumer;
// use Hyperf\Amqp\Message\ConsumerMessage;
// use PhpAmqpLib\Message\AMQPMessage;

// /**
//  * @Consumer(exchange="hyperf", routingKey="hyperf", queue="hyperf", name="DemoConsumer", nums=5)
//  */
// #[Consumer(exchange: 'hyperf', routingKey: 'hyperf', queue: 'hyperf', name: "DemoConsumer", nums: 1, enable: false)]
// class DemoConsumer extends ConsumerMessage
// {
//     public function consumeMessage($data, AMQPMessage $message): string
//     {
//         sleep(3);
//         print_r($data);
//         sleep(5);
//         // throw new \Exception('Value must be 1 or below');
//         // return Result::NACK;
//         return Result::ACK;
//     }

//     public function isEnable(): bool
//     {
//         // return parent::isEnable();
//         return false;
//     }
// }

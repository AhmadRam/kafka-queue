<?php

namespace Ahmadramadan\KafkaQueue;

use Illuminate\Database\Connectors\ConnectorInterface;
use RdKafka\Conf;
use RdKafka\KafkaConsumer;
use RdKafka\Producer;

class KafkaConnector implements ConnectorInterface
{

    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config)
    {
        $conf = new Conf();

        $conf->set('bootstrap.servers', $config['bootstrap_servers']);
        // $conf->set('metadata.broker.list', $config['bootstrap_servers']);
        // $conf->set('sasl.mechanisms', $config['sasl_mechanisms']);
        // $conf->set('security.protocol', $config['security_protocol']);
        // $conf->set('sasl.username', $config['sasl_username']);
        // $conf->set('sasl.password', $config['sasl_password']);
        $producer = new Producer($conf);

        $conf->set('group.id', $config['group_id']);
        $conf->set('auto.offset.reset', 'earliest');

        // $conf->set('enable.auto.commit', 'false');

        $consumer = new KafkaConsumer($conf);

        return new KafkaQueue($producer, $consumer);
    }
}

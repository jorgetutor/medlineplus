<?php

namespace Tutor\MedlinePlus;

use Guzzle\Service\Loader\JsonLoader;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Symfony\Component\Config\FileLocator;

/**
 * A MedlinePlusClient
 */
class MedlinePlusClient extends GuzzleClient
{
    /**
     * Factory method to create a new MedlinePlusClient
     *
     * @param array $config Configuration data
     * @return MedlinePlusClient
     * @throws \Exception
     */
    public static function factory($config = [])
    {
        $clientConfig = self::getClientConfig($config);
        $guzzleClient = new Client($clientConfig);
        $description = self::getAPIDescriptionByJsonFile('services.json');
        $client = new GuzzleClient($guzzleClient, $description);
        return $client;
    }

    protected static function getAPIDescriptionByJsonFile($file)
    {
        $configDirectories = [__DIR__];
        $locator = new FileLocator($configDirectories);
        $jsonLoader = new JsonLoader($locator);
        $description = $jsonLoader->load($locator->locate($file));
        $description = new Description($description);
        return $description;
    }

    protected static function getClientConfig($config)
    {
        $clientConfig = [];
        if (isset($config['debug']) && is_bool($config['debug'])) {
            $clientConfig['debug'] = $config['debug'];
        }
        return $clientConfig;
    }

    /**
     * Shortcut for executing Commands in the Definitions.
     *
     * @param string $method
     * @param array|null $args
     *
     * @return mixed|void
     */
    public function __call($method, array $args)
    {
        $commandName = ucfirst($method);
        /** @var \GuzzleHttp\Command\Result $result */
        $result = parent::__call($commandName, $args);
        return $result;
    }
}

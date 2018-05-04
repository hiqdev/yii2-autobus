<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\autobus\bus;

use League\Tactician\Middleware;
use Psr\Http\Message\ServerRequestInterface;
use yii\base\Model;

/**
 * Class LoadFromRequestMiddleware takes data from POST or (if it is empty) from GET request,
 * trims all the values and tries to load them to the command.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class LoadFromRequestMiddleware implements Middleware
{
    /**
     * @var ServerRequestInterface
     */
    private $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param object|Model $command
     * @param callable $next
     * @throws \Exception
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        if (!$command instanceof Model) {
            // TODO: specific exception
            throw new \Exception('This middleware can load only commands of Model class');
        }

        $data = $this->request->getParsedBody() ?: $this->request->getQueryParams();
        array_walk_recursive($data, function (&$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        });

        $successLoad = $command->load($data, '');
        if (!$successLoad) {
            // TODO: specific exception
            throw new \Exception('Failed to load command');
        }

        return $next($command);
    }
}

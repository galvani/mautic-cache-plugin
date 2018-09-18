<?php

declare(strict_types=1);

namespace MauticPlugin\MauticCacheBundle\Cache\Adapter;

/*
 * @copyright   2018 Mautic Inc. All rights reserved
 * @author      Mautic, Inc. Jan Kozak <galvani78@gmail.com>
 *
 * @link        http://mautic.com
 * @created     12.9.18
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

use Symfony\Component\Cache\Adapter\AdapterInterface;

class FilesystemAdapter extends \Symfony\Component\Cache\Adapter\FilesystemAdapter implements AdapterInterface
{

}

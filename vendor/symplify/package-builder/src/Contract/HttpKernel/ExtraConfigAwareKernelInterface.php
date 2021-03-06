<?php

declare (strict_types=1);
namespace MonorepoBuilder20210715\Symplify\PackageBuilder\Contract\HttpKernel;

use MonorepoBuilder20210715\Symfony\Component\HttpKernel\KernelInterface;
use MonorepoBuilder20210715\Symplify\SmartFileSystem\SmartFileInfo;
interface ExtraConfigAwareKernelInterface extends \MonorepoBuilder20210715\Symfony\Component\HttpKernel\KernelInterface
{
    /**
     * @param string[]|SmartFileInfo[] $configs
     */
    public function setConfigs($configs) : void;
}

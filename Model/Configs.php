<?php 

declare(strict_types=1);

namespace InfoBase\FAQ\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Configs
 * @package InfoBase\FAQ\Model
 */
class Configs
{
    const XML_PATH_IS_ENABLED = 'infobase_faq/settings/enabled';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /** 
     * @return bool
     */
    public function isEnabled() : bool
    {
        return 1 === (int) $this->scopeConfig->getValue(self::XML_PATH_IS_ENABLED, ScopeInterface::SCOPE_STORE);
    }
}

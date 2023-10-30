<?php
/**
 * MageINIC
 * Copyright (C) 2023 MageINIC <support@mageinic.com>
 *
 * NOTICE OF LICENSE
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see https://opensource.org/licenses/gpl-3.0.html.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category MageINIC
 * @package MageINIC_TestimonialGraphQl
 * @copyright Copyright (c) 2023 MageINIC (https://www.mageinic.com/)
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MageINIC <support@mageinic.com>
 */

namespace MageINIC\TestimonialGraphQl\Model\Resolver\DataProvider;

use MageINIC\Testimonial\Api\Data\TestimonialInterface;
use Magento\Framework\GraphQl\Config\Element\TypeInterface;
use Magento\Framework\GraphQl\ConfigInterface as Config;
use Magento\Framework\GraphQl\Query\Resolver\Argument\FieldEntityAttributesInterface;

/**
 * Class For Testimonial Filter Data
 */
class FilterData implements FieldEntityAttributesInterface
{
    /**
     * define filter input name
     */
    public const TESTIMONIAL_FILTER_INPUT = "TestimonialFilterInput";

    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var array
     */
    private array $additionalAttributes = [];

    /**
     * FilterData Constructor.
     *
     * @param Config $config
     * @param array $additionalAttributes
     */
    public function __construct(
        Config $config,
        array  $additionalAttributes = []
    ) {
        $this->config = $config;
        $this->additionalAttributes = array_merge($this->additionalAttributes, $additionalAttributes);
    }

    /**
     * @inheritdoc
     */
    public function getEntityAttributes(): array
    {
        /** @var TypeInterface $filterSchema */
        $filterSchema = $this->config->getConfigElement(self::TESTIMONIAL_FILTER_INPUT);
        $attributeFilterFields = $filterSchema->getFields();

        $filterFields = [];
        foreach ($attributeFilterFields as $filterField) {
            $filterFields[$filterField->getName()] = [
                'type' => 'String',
                'fieldName' => $filterField->getName(),
            ];
        }

        foreach ($this->additionalAttributes as $attribute) {
            $filterFields[$attribute] = [
                'type' => 'String',
                'fieldName' => $attribute,
            ];
        }

        return $filterFields;
    }
}

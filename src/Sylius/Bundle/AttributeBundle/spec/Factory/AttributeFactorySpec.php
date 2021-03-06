<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\AttributeBundle\Factory;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Attribute\AttributeType\AttributeTypeInterface;
use Sylius\Component\Attribute\Model\Attribute;
use Sylius\Component\Registry\ServiceRegistryInterface;
use Sylius\Component\Translation\Factory\TranslatableFactory;
use Sylius\Component\Translation\Factory\TranslatableFactoryInterface;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class AttributeFactorySpec extends ObjectBehavior
{
    function let(TranslatableFactory $factory, ServiceRegistryInterface $attributeTypesRegistry)
    {
        $this->beConstructedWith($factory, $attributeTypesRegistry);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AttributeBundle\Factory\AttributeFactory');
    }

    function it_implements_translatable_factory_interface()
    {
        $this->shouldImplement(TranslatableFactoryInterface::class);
    }

    function it_creates_new_attribute($attributeTypesRegistry, $factory, Attribute $attribute, AttributeTypeInterface $attributeType)
    {
        $factory->createNew()->willReturn($attribute);

        $attributeType->getStorageType()->willReturn('text');
        $attributeTypesRegistry->get('text')->willReturn($attributeType);

        $attribute->getType()->willReturn('text');
        $attribute->setStorageType('text')->shouldBeCalled();

        $this->createNew()->shouldReturn($attribute);
    }

    function it_creates_typed_attribute($attributeTypesRegistry, $factory, Attribute $typedAttribute, AttributeTypeInterface $attributeType)
    {
        $factory->createNew()->willReturn($typedAttribute);

        $attributeType->getStorageType()->willReturn('datetime');
        $attributeTypesRegistry->get('datetime')->willReturn($attributeType);

        $typedAttribute->setType('datetime')->shouldBeCalled();
        $typedAttribute->getType()->willReturn('datetime');
        $typedAttribute->setStorageType('datetime')->shouldBeCalled();

        $this->createTyped('datetime')->shouldReturn($typedAttribute);
    }
}

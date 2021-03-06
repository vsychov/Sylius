<?php

namespace spec\Sylius\Component\Translation\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Translation\Model\AbstractTranslation;
use Sylius\Component\Translation\Model\TranslatableInterface;
use Sylius\Component\Translation\Model\TranslationInterface;

class AbstractTranslationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('spec\Sylius\Component\Translation\Model\ConcreteTranslation');
    }

    function it_is_a_translation()
    {
        $this->shouldImplement(TranslationInterface::class);
    }

    function its_translatable_is_mutabale(TranslatableInterface $translatable)
    {
        $this->setTranslatable($translatable);
        $this->getTranslatable()->shouldReturn($translatable);
    }

    function its_detaches_from_its_translatable_correctly(
        TranslatableInterface $translatable1,
        TranslatableInterface $translatable2
    ) {
        $translatable1->addTranslation(Argument::type(AbstractTranslation::class));
        $this->setTranslatable($translatable1);

        $translatable1->removeTranslation(Argument::type(AbstractTranslation::class));
        $translatable2->addTranslation(Argument::type(AbstractTranslation::class));
        $this->setTranslatable($translatable2);
    }

    function its_locale_is_mutable()
    {
        $this->setLocale('en');
        $this->getLocale()->shouldReturn('en');
    }
}

class ConcreteTranslation extends AbstractTranslation
{
}

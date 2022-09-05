<?php

namespace App\tests\unit;

use App\DTO\LowestPriceEnquiry;
use App\Event\AfterDtoCreatedEvent;
use App\EventSubscriber\DtoSubscriber;
use App\Service\ServiceException;
use App\Tests\ServiceTestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class DtoSubscriberTest extends ServiceTestCase
{

    public function testEventSubcription(): void
    {
        $this->assertArrayHasKey(AfterDtoCreatedEvent::NAME, DtoSubscriber::getSubscribedEvents());
    }

    /** @test */
    public function a_dto_is_validated_after_it_has_been_created(): void
    {
        // Given
        $dto = new LowestPriceEnquiry();
        $dto->setQuantity(-5);
        $event = new AfterDtoCreatedEvent($dto);
        $eventDispatcher = $this->container->get(EventDispatcherInterface::class);

        // Expect
        $this->expectException(ServiceException::class);
        $this->expectExceptionMessage('ConstraintViolationList');

        // When
        $eventDispatcher->dispatch($event, $event::NAME);
    }

}
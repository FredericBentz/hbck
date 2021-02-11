<?php

namespace App\EventSubscriber;

use App\Repository\SeasonRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{

    private $seasonRepository;
    private $router;

    public function __construct(
        SeasonRepository $seasonRepository,
        UrlGeneratorInterface $router
    )
    {
        $this->seasonRepository = $seasonRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();


        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        $seasons = $this->seasonRepository
            ->createQueryBuilder('season')
            ->where('season.beginAt BETWEEN :start and :end OR season.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();

        foreach ($seasons as $season) {
            // this create the events with your data (here booking data) to fill calendar
            $seasonEvent = new Event(
                $season->getTitle(),
                $season->getBeginAt(),
                $season->getEndAt() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $seasonEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            $seasonEvent->addOption(
                'url',
                $this->router->generate('season_show', [
                    'id' => $season->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($seasonEvent);

            // You may want to make a custom query from your database to fill the calendar

            $calendar->addEvent(new Event(
                'Event 1',
                new \DateTime('Tuesday this week'),
                new \DateTime('Wednesdays this week')
            ));

            // If the end date is null or not defined, it creates a all day event
            $calendar->addEvent(new Event(
                'All day event',
                new \DateTime('Friday this week')
            ));
        }
    }
}


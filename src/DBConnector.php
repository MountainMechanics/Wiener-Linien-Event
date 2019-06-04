<?php

class DBConnector{


    static function createEvent($conn){

        $queryBuilder = $conn->createQueryBuilder();

        $queryBuilder
            ->select('MAX(pk_id)')
            ->from('events_');

        $GLOBALS['event_id'] = $queryBuilder->execute()->fetch();
        $GLOBALS['event_id']['MAX(pk_id)'] = (int)($GLOBALS['event_id']['MAX(pk_id)'])+1;


        $queryBuilder
            ->insert('events_')
            ->values(
                array(
                    'pk_id' => '?',
                    'description' => '?',
                    'plz' => '?',
                    'ort' => '?',
                    'strasse' => '?',
                    'title' => '?',
                    'opening_text' => '?',
                    'second_text' => '?',
                    'date_begin' => '?',
                    'time_begin' => '?',
                    'time_end' => '?',
                    'agenda' => '?',
                    'fk_creator' => '?'
                )
            )
            ->setParameter(0, $GLOBALS['event_id']['MAX(pk_id)'])
            ->setParameter(1, $_POST['event-descr'])
            ->setParameter(2, $_POST['plz'])
            ->setParameter(3, $_POST['ort'])
            ->setParameter(4, $_POST['straße'])
            ->setParameter(5, $_POST['eventTitel'])
            ->setParameter(6, $_POST['event-detail'])
            ->setParameter(7, '')
            ->setParameter(8, $_POST['date'])
            ->setParameter(9, $_POST['time-begin'])
            ->setParameter(10, $_POST['time-end'])
            ->setParameter(11,file_get_contents($_FILES['event-agenda']['tmp_name']))
            ->setParameter(12, $_SESSION['userID']);

        $queryBuilder->execute();
    }


    static function createParticipants($conn,$recipients)
    {

        $queryBuilder = $conn->createQueryBuilder();

        foreach ($recipients as $recipient) {
            $queryBuilder
                ->insert('participants')
                ->values(
                    array(
                        'pk_id' => '?',
                        'first_name' => '?',
                        'last_name' => '?',
                        'fk_event' => '?',
                        'token' => '?',
                        'answer' => '?',
                        'teilnahme' => '?'
                    )
                )
                ->setParameter(0, null)
                ->setParameter(1, $recipient['B'])
                ->setParameter(2, $recipient['C'])
                ->setParameter(3, $GLOBALS['event_id']['MAX(pk_id)'])
                ->setParameter(4, $recipient['token'])
                ->setParameter(5, '')
                ->setParameter(6, 0);

            $queryBuilder->execute();
        }
    }

}

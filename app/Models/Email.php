<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\EmailStatus;
use App\Model;
use Symfony\Component\Mime\Address;

class Email extends Model
{
    public function queue(
        Address $to,
        Address $from,
        string $subject,
        string $html,
        ?string $text = null
    ): void {
        $stmt = $this->db->prepare(
            'INSERT INTO emails (subject, status, html_body, text_body, meta, created_at)
             VALUES (?, ?, ?, ?, ?, NOW())'
        );

        $meta['to']   = $to->toString();
        $meta['from'] = $from->toString();

        $stmt->bindValue(1, $subject);
        $stmt->bindValue(2, EmailStatus::Queue->value);
        $stmt->bindValue(3, $html);
        $stmt->bindValue(4, $text);
        $stmt->bindValue(5, json_encode($meta));
        $stmt->executeQuery();
    }

    public function getEmailsByStatus(EmailStatus $status): array
    {
        $stmt = $this->db->prepare(
            'SELECT *
             FROM emails
             WHERE status = ?'
        );
        $stmt->bindValue(1, $status->value);

        return $stmt->executeQuery()->fetchAllAssociative();
    }

    public function markEmailSent(int $id): void
    {
        $stmt = $this->db->prepare(
            'UPDATE emails
             SET status = ?, sent_at = NOW()
             WHERE id = ?'
        );
        $stmt->bindValue(1, EmailStatus::Sent->value);
        $stmt->bindValue(2, $id);

        $stmt->executeStatement();
    }
}
?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;

class NotificationService
{
    /**
     * Create a new notification
     *
     * @param int $userId
     * @param string $message
     * @param string $type
     * @param array|null $data
     * @return Notification
     */
    public static function notify(int $userId, string $message, string $type = 'info', ?array $data = null): Notification
    {
        return Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'type' => $type,
            'is_read' => false,
            'data' => $data,
        ]);
    }
    
    /**
     * Create a notification for a debt
     *
     * @param User $userTo Recipient of the notification
     * @param User $userFrom The user who created the debt
     * @param float $amount
     * @param string $debtName
     * @return Notification
     */
    public static function notifyDebt(User $userTo, User $userFrom, float $amount, string $debtName): Notification
    {
        $message = "{$userFrom->name} a créé un nouvel emprunt de {$amount} MAD pour '{$debtName}'";
        
        return self::notify($userTo->id, $message, 'debt', [
            'from_user_id' => $userFrom->id,
            'amount' => $amount,
            'debt_name' => $debtName,
        ]);
    }
    
    /**
     * Create a notification for a friend request
     *
     * @param User $userTo Recipient of the notification
     * @param User $userFrom The user who sent the friend request
     * @return Notification
     */
    public static function notifyFriendRequest(User $userTo, User $userFrom): Notification
    {
        $message = "{$userFrom->name} vous a ajouté comme ami";
        
        return self::notify($userTo->id, $message, 'friend', [
            'from_user_id' => $userFrom->id,
        ]);
    }
    
    /**
     * Create a notification for an upcoming due date
     *
     * @param User $user
     * @param string $debtName
     * @param string $dueDate
     * @param int $debtId
     * @return Notification
     */
    public static function notifyUpcomingDueDate(User $user, string $debtName, string $dueDate, int $debtId): Notification
    {
        $message = "Le remboursement pour '{$debtName}' est prévu pour le {$dueDate}";
        
        return self::notify($user->id, $message, 'due_date', [
            'debt_id' => $debtId,
            'due_date' => $dueDate,
        ]);
    }
    
    /**
     * Mark notification as read
     *
     * @param int $notificationId
     * @return bool
     */
    public static function markAsRead(int $notificationId): bool
    {
        $notification = Notification::find($notificationId);
        
        if ($notification) {
            $notification->is_read = true;
            return $notification->save();
        }
        
        return false;
    }
    
    /**
     * Mark all notifications as read for a user
     *
     * @param int $userId
     * @return int Number of updated rows
     */
    public static function markAllAsRead(int $userId): int
    {
        return Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }
}
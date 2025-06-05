<?php

use Entity\Bill;
use Entity\Position;

require_once 'Entity/Bill.php';
require_once 'Entity/Position.php';

/**
 * Сервис для рабыты со счетами
 */
class BillService
{
    private PDO $conn;

    public function __construct(DbManager $dbManager)
    {
        $this->conn = $dbManager->getConnect();
    }

    /**
     * Получает счета с позициями,
     * выбранные по статусу и начиная с указанной временной точки.
     *
     * @param BillStatusEnum $status
     * @param DateTime $created
     * @return array
     */
    public function getByStatusAndCreated(BillStatusEnum $status, DateTime $created): array
    {
        $data = [];

        $sql = 'SELECT * FROM bills WHERE status = :status AND created >= :created';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":status", $status->value);
        $stmt->bindValue(":created", $created->format("Y-m-d H:i:s"));
        $stmt->execute();
        $values = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($values as $v) {
            $bill = (new Bill())
                ->setId($v->id)
                ->setNumber($v->number)
                ->setStatus(BillStatusEnum::from($v->status))
                ->setCreated(DateTime::createFromFormat("Y-m-d H:i:s", $v->created))
                ->setDiscount($v->discount);
            $positions = $this->getPositionsByBill($bill);
            $data[] = [
                'bill' => $bill,
                'positions' => $positions,
                'amount' => $this->calculateBillAmount($bill, $positions)
            ];
        }

        return $data;
    }

    /**
     * @param Bill $bill
     * @return Position[]
     */
    public function getPositionsByBill(Bill $bill): array
    {
        $data = [];

        $sql = 'SELECT * FROM positions WHERE bill_id = :bill_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":bill_id", $bill->getId());
        $stmt->execute();
        $values = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($values as $v) {
            $data[] = (new Position())
                ->setPositionId($v->position_id)
                ->setBill($bill)
                ->setName($v->name)
                ->setQuantity($v->quantity)
                ->setPrice($v->price);
        }

        return $data;
    }

    /**
     * Считает сумма счета
     *
     * @param Bill $bill
     * @param Position[] $positions
     * @return float
     * @todo хорошая практика работать только с копейками, центами
     */
    public function calculateBillAmount(Bill $bill, array $positions): float
    {
        $amount = 0;
        foreach ($positions as $p) {
            /** @var Position $p */
            $amount += $p->getPrice() * $p->getQuantity();
        }
        $amount -= $bill->getDiscount() ?: 0;
        $amount = max($amount, 0);
        return round($amount, 2);
    }

    /**
     * Сохрняет или обновляет счета в БД
     *
     * @param Bill $bill
     * @return Bill
     */
    public function saveBill(Bill $bill): Bill
    {
        if (is_null($bill->getId())) {
            //  create new
        } else {
            // update
        }
        return $bill;
    }

    /**
     * Сохрняет или обновляет позицию счета в БД
     *
     * @param Position $position
     * @return Position
     */
    public function savePosition(Position $position): Position
    {
        if (is_null($position->getPositionId())) {
            //  create new
        } else {
            // update
        }
        return $position;
    }

    /**
     * Удаляет позицию из БД
     *
     * @param Position $position
     * @return bool
     */
    public function deletePosition(Position $position): bool
    {
        if (is_null($position->getPositionId())) {
            return false;
        }

        // delete position
        return false;
    }
}

<?php
class Sales
{
    public $id;
    public $receipt_number;
    public $price;
    public $created_at;
}

class SalesRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function getAllSales()
    {
        $sql = "SELECT * FROM sales ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function periodDate($year, $month)
    {
        $from_at = sprintf('%04d-%02d-01 00:00:00', $year, $month);
        $to_at = date('Y-m-d 00:00:00', strtotime("$from_at +1 month"));

        return [
            'from_at' => $from_at,
            'to_at' => $to_at,
        ];
    }

    public function getSalesByMonth($year, $month)
    {
        if ($year == 0 || $month == 0) {
            return [];
        }

        $period = $this->periodDate($year, $month);

        $sql = "SELECT * FROM sales 
                WHERE created_at >= :from_at 
                    AND created_at < :to_at
                ORDER BY created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':from_at' => $period['from_at'],
            ':to_at' => $period['to_at'],
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($sale)
    {
        $sale->receipt_number = 'R' . date('YmdHis') . rand(100, 999);

        $sql = "INSERT INTO sales (receipt_number, price) VALUES (:receipt_number, :price)";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            ':receipt_number' => $sale->receipt_number,
            ':price' => $sale->price,
        ]);
        return $result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM sales WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}

class SalesService
{
    private $salesRepository;

    public function __construct()
    {
        $this->salesRepository = new SalesRepository();
    }

    public function getAllSales()
    {
        return $this->salesRepository->getAllSales();
    }

    public function getSalesByMonth($year, $month)
    {
        return $this->salesRepository->getSalesByMonth($year, $month);
    }

    public function insert($sale)
    {
        return $this->salesRepository->insert($sale);
    }

    public function delete($id)
    {
        return $this->salesRepository->delete($id);
    }

    public function getTotalSales($sales)
    {
        return array_sum(array_column($sales, 'price'));
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerAccountModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'account_number',
        'customer_name',
        'address',
        'phone',
        'email',
        'meter_number',
        'connection_type',
        'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'id'               => 'permit_empty|integer',
        'account_number'   => 'required|max_length[50]|is_unique[customer_accounts.account_number,id,{id}]',
        'customer_name'    => 'required|min_length[2]|max_length[255]',
        'address'          => 'required|min_length[5]|max_length[255]',
        'phone'            => 'required|min_length[7]|max_length[20]',
        'email'            => 'required|valid_email|max_length[255]',
        'meter_number'     => 'required|min_length[2]|max_length[100]',
        'connection_type'  => 'required|in_list[residential,commercial,industrial]',
        'status'           => 'required|in_list[active,inactive,suspended]',
    ];

    protected $validationMessages = [
        'connection_type' => [
            'in_list' => 'Please select a valid connection type.',
        ],
        'status' => [
            'in_list' => 'Please select a valid account status.',
        ],
    ];

    public function getAccountsPaginated($perPage = 10)
    {
        return $this->orderBy('created_at', 'DESC')->paginate($perPage);
    }
    public function getFilteredAccounts(
        ?string $keyword,
        ?string $status,
        ?string $type,
        int $perPage = 10
    ) {
        if ($keyword = trim((string) $keyword)) {
            $this->groupStart()
                ->like('account_number', $keyword)
                ->orLike('customer_name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
                ->groupEnd();
        }

        if ($status) {
            $this->where('status', $status);
        }

        if ($type) {
            $this->where('connection_type', $type);
        }

        return $this->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }
    public function getAccountsByStatus($status, $perPage = 10)
    {
        return $this->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }
    public function getAccountsByType($type, $perPage = 10)
    {
        return $this->where('connection_type', $type)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }
    public function getTotalAccounts()
    {
        return $this->countAllResults();
    }
    public function getCountByStatus($status)
    {
        return $this->where('status', $status)->countAllResults();
    }
}

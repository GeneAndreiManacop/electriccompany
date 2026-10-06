<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    /**
     * Display dashboard with customer accounts list (paginated)
     */
    public function index()
    {
        // Get search keyword if exists
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $type = $this->request->getGet('type');

        // Items per page
        $perPage = (int) $this->request->getGet('per_page');

        if ($perPage < 1) {
            $perPage = 10;
        }

        $perPage = min($perPage, 100);

        // Get paginated data based on filters
        $accounts = $this->customerModel->getFilteredAccounts($keyword, $status, $type, $perPage);

        // Get statistics
        $data = [
            'accounts' => $accounts,
            'pager' => $this->customerModel->pager,
            'per_page' => $perPage,
            'total_accounts' => $this->customerModel->getTotalAccounts(),
            'active_accounts' => $this->customerModel->getCountByStatus('active'),
            'inactive_accounts' => $this->customerModel->getCountByStatus('inactive'),
            'suspended_accounts' => $this->customerModel->getCountByStatus('suspended'),
            'current_page' => $this->request->getGet('page') ?? 1,
            'search_keyword' => $keyword,
            'filter_status' => $status,
            'filter_type' => $type
        ];

        return view('dashboard', $data);
    }

    /**
     * View single account details
     */
    public function viewAccount($id)
    {
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to('/')->with('error', 'Account not found');
        }

        $data = [
            'account' => $account
        ];

        return view('view_account', $data);
    }

    /**
     * Display the customer account creation form.
     */
    public function create()
    {
        if ($this->request->getMethod() == 'POST') {
            $accountData = [
                'account_number' => trim((string) $this->request->getPost('account_number')),
                'customer_name' => trim((string) $this->request->getPost('customer_name')),
                'address' => trim((string) $this->request->getPost('address')),
                'phone' => trim((string) $this->request->getPost('phone')),
                'email' => trim((string) $this->request->getPost('email')),
                'meter_number' => trim((string) $this->request->getPost('meter_number')),
                'connection_type' => $this->request->getPost('connection_type'),
                'status' => $this->request->getPost('status'),
            ];

            if (! $this->customerModel->insert($accountData)) {
                session()->setFlashdata('validation', $this->customerModel->errors());
                return redirect()->back()->withInput();
            }

            return redirect()->to('/create')->with('success', 'Customer account created successfully.');
        }

        return view('create_account', [
            'validation' => session()->getFlashdata('validation'),
            'error' => session()->getFlashdata('error'),
            'success' => session()->getFlashdata('success'),
        ]);
    }

    public function edit($id)
    {
        $account = $this->customerModel->find($id);

        if (! $account) {
            return redirect()->to('/dashboard')
                ->with('error', 'Account not found.');
        }

        return view('edit_account', [
            'account' => $account,
            'validation' => session()->getFlashdata('validation'),
        ]);
    }

    public function update($id)
    {
        $account = $this->customerModel->find($id);

        if (! $account) {
            return redirect()->to('/dashboard')
                ->with('error', 'Account not found.');
        }

        $data = [
            'id' => $id,
            'account_number' => trim((string) $this->request->getPost('account_number')),
            'customer_name' => trim((string) $this->request->getPost('customer_name')),
            'address' => trim((string) $this->request->getPost('address')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'email' => trim((string) $this->request->getPost('email')),
            'meter_number' => trim((string) $this->request->getPost('meter_number')),
            'connection_type' => $this->request->getPost('connection_type'),
            'status' => $this->request->getPost('status'),
        ];

        if (! $this->customerModel->update($id, $data)) {
            session()->setFlashdata('validation', $this->customerModel->errors());
            return redirect()->back()->withInput();
        }

        return redirect()->to('/account/' . $id)
            ->with('success', 'Account updated successfully.');
    }

    public function delete($id)
    {
        $account = $this->customerModel->find($id);

        if (! $account) {
            return redirect()->to('/dashboard')
                ->with('error', 'Account not found.');
        }

        if (! $this->customerModel->delete($id)) {
            return redirect()->back()
                ->with('error', 'Unable to delete the account.');
        }

        return redirect()->to('/dashboard')
            ->with('success', 'Customer account deleted successfully.');
    }
}

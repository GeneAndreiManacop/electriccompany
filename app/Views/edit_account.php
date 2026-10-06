<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details - Puihaha Electric Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 20px auto;
            max-width: 800px;
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-section h1 {
            color: #667eea;
            font-weight: bold;
        }

        .info-group {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #666;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.1rem;
            color: #333;
        }

        .badge-active {
            background-color: #28a745;
        }

        .badge-inactive {
            background-color: #dc3545;
        }

        .badge-suspended {
            background-color: #ffc107;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-container">
            <!-- Header -->
            <div class="header-section">
                <h1><i class="bi bi-lightning-charge-fill text-warning"></i> Puihaha Electric Company</h1>
                <p class="text-muted">Customer Account Details</p>
            </div>

            <!-- Back Button -->
            <div class="mb-4">
                <a href="<?= base_url("dashboard") ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <?php if (! empty($validation)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Please correct the following:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($validation as $message): ?>
                            <li><?= esc($message) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Account Information -->

            <form method="post" action="<?= base_url('account/' . $account['id'] . '/update') ?>" onsubmit="return confirm('Are you sure you want to update this account?');">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="account_number" class="form-label">Account Number</label>
                    <input type="text" id="account_number" name="account_number"
                        class="form-control"
                        value="<?= esc(old('account_number', $account['account_number'])) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name"
                        class="form-control"
                        value="<?= esc(old('customer_name', $account['customer_name'])) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address"
                        class="form-control"
                        value="<?= esc(old('address', $account['address'])) ?>"
                        required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" id="phone" name="phone"
                            class="form-control"
                            value="<?= esc(old('phone', $account['phone'])) ?>"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control"
                            value="<?= esc(old('email', $account['email'])) ?>"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="meter_number" class="form-label">Meter Number</label>
                    <input type="text" id="meter_number" name="meter_number"
                        class="form-control"
                        value="<?= esc(old('meter_number', $account['meter_number'])) ?>"
                        required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="connection_type" class="form-label">Connection Type</label>
                        <select id="connection_type" name="connection_type" class="form-select" required>
                            <?php foreach (['residential', 'commercial', 'industrial'] as $type): ?>
                                <option value="<?= $type ?>"
                                    <?= old('connection_type', $account['connection_type']) === $type ? 'selected' : '' ?>>
                                    <?= ucfirst($type) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <?php foreach (['active', 'inactive', 'suspended'] as $status): ?>
                                <option value="<?= $status ?>"
                                    <?= old('status', $account['status']) === $status ? 'selected' : '' ?>>
                                    <?= ucfirst($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100 mt-3 text-center">  
                    
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Puihaha Electric Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= base_url('assets/favicon.png') ?>">
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
            max-width: 900px;
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-section h1 {
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-container">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                </a>
                <h1 class="h3 mb-0 text-primary">Create Account</h1>
            </div>

            <div class="header-section">
                <h1><i class="bi bi-person-plus-fill text-warning"></i> Customer Account</h1>
                <p class="text-muted mb-0">Add a new customer account to the system</p>
            </div>

            <?php if (! empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= esc($error) ?>
                </div>
            <?php endif; ?>

            <?php if (! empty($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= esc($success) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url('create') ?>">
                <?= csrf_field() ?>


                <div class="row g-3">
                    <!-- Customer Name -->
                    <div class="col-md-6">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name"
                            class="form-control <?= isset($validation['customer_name']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('customer_name')) ?>" required>
                        <?php if (isset($validation['customer_name'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['customer_name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Account Number -->
                    <div class="col-md-6">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" id="account_number" name="account_number"
                            class="form-control <?= isset($validation['account_number']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('account_number')) ?>" required>
                        <?php if (isset($validation['account_number'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['account_number']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Address  -->
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control <?= isset($validation['address']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('address')) ?>" required>
                        <?php if (isset($validation['address'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['address']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" id="phone" name="phone"
                            class="form-control <?= isset($validation['phone']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('phone')) ?>" required>
                        <?php if (isset($validation['phone'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['phone']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control <?= isset($validation['email']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('email')) ?>" required>
                        <?php if (isset($validation['email'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['email']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Meter Number -->
                    <div class="col-md-6">
                        <label for="meter_number" class="form-label">Meter Number</label>
                        <input type="text" id="meter_number" name="meter_number"
                            class="form-control <?= isset($validation['meter_number']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('meter_number') ?: 'MTR-') ?>" required>
                        <?php if (isset($validation['meter_number'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['meter_number']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-3">
                        <label for="connection_type" class="form-label">Connection Type</label>
                        <select id="connection_type" name="connection_type"
                            class="form-select <?= isset($validation['connection_type']) ? 'is-invalid' : '' ?>" required>
                            <option value="">Select type</option>
                            <?php foreach (['residential', 'commercial', 'industrial'] as $type): ?>
                                <option value="<?= $type ?>" <?= old('connection_type') === $type ? 'selected' : '' ?>>
                                    <?= ucfirst($type) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($validation['connection_type'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['connection_type']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status"
                            class="form-select <?= isset($validation['status']) ? 'is-invalid' : '' ?>" required>
                            <?php $selectedStatus = old('status') ?: 'active'; ?>
                            <?php foreach (['active', 'inactive', 'suspended'] as $status): ?>
                                <option value="<?= $status ?>" <?= $selectedStatus === $status ? 'selected' : '' ?>>
                                    <?= ucfirst($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($validation['status'])): ?>
                            <div class="invalid-feedback"><?= esc($validation['status']) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 6) {
                value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            } else if (value.length >= 3) {
                value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
            }
            e.target.value = value;
        });

        const form = document.querySelector('form');
        const accountInput = document.getElementById('account_number');
        const meterInput = document.getElementById('meter_number');
        const currentYear = new Date().getFullYear();

        function formatAccountNumber() {
            const digits = accountInput.value
                .replace(/\D/g, '')
                .slice(-4)
                .padStart(4, '0');

            accountInput.value = `EC-${currentYear}-${digits}`;
        }

        function formatMeterNumber() {
            const digits = meterInput.value.replace(/\D/g, '');

            meterInput.value = digits ?
                `MTR-${digits}` :
                'MTR-';
        }

        accountInput.addEventListener('input', formatAccountNumber);
        meterInput.addEventListener('input', formatMeterNumber);

        form.addEventListener('submit', function() {
            formatAccountNumber();
            formatMeterNumber();
        });

        formatAccountNumber();
        formatMeterNumber();
    });
</script>

</html>
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<section class="hero-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-4 fw-bold mb-4">Welcome Back</h1>
                <p class="lead">Sign in to manage your electrical services and account.</p>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light-custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h2 class="h3 fw-bold text-primary-custom mb-2">Sign In</h2>
                            <p class="text-muted mb-0">Access your Puihaha Electric account</p>
                        </div>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?= esc(session()->getFlashdata('error')) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?= esc(session()->getFlashdata('success')) ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('login') ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control form-control-lg" name="email" id="email"
                                    value="<?= esc(old('email')) ?>" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group input-group-lg">
                                    <input type="password" class="form-control" name="password" id="password" required data-password-strength="false">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                        aria-label="Show password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 btn-lg w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>

                        <p class="text-center text-muted mt-4 mb-0">
                            New customer? <a href="<?= base_url('register') ?>" class="text-primary-custom fw-semibold">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        const isPassword = password.type === 'password';

        password.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !isPassword);
        icon.classList.toggle('fa-eye-slash', isPassword);
        this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
    });
</script>
<?= $this->endSection() ?>
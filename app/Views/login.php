<?= $this->extend('theme')?>

<?= $this->section('content')?>



                    <div class="login-wrapper">

                        <?= form_open('auth/checkLogin'); ?>
                        <div class="login-box">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="title">Login</h2>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <input type="text" name="nik" placeholder="NIK"
                                        class="form-control form-control-lg <?= (session()->has('error')) ? 'border-danger' : '';?>"
                                        value="dummy" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <input type="password" placeholder="Password" name="password" value="dummy"
                                        class="form-control form-control-lg <?= (session()->has('error')) ? 'border-danger' : '';?>" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                                    <a href="<?= site_url('forgot_password');?>"></a>
                                </div>
                            </div>
                        </div>
                        </form>

                    </div>


<?= $this->endSection()?>
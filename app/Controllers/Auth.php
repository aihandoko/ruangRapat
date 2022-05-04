<?php

namespace App\Controllers;

// use App\Libraries\Common;
// use CodeIgniter\I18n\Time;
// use Exception;

class Auth extends BaseController {

    public function login() {
        return view('login');
    }

    public function checkLogin() {
    //     $email = $this->request->getPost('email');
    //     $password = $this->request->getPost('password');

    //     $auth = service('auth');

    //     $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
    //     $userIp = $this->request->getIPAddress();

    //     $credential = array(
    //         'secret' => '6Le5VGkeAAAAAFBll9PPU-bDfudulLtrATf_JcZk',
    //         'response' => $this->request->getVar('g-recaptcha-response')
    //     );
    //     $verify = curl_init();
    //     curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    //     curl_setopt($verify, CURLOPT_POST, true);
    //     curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
    //     curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($verify);
    //     $status= json_decode($response, true);
        
    //     if($status['success']) {
    //         if($auth->login($email, $password)) {
    //             $redirect = session('redirect_url') ?? '/';
    //             unset($_SESSION['redirect_url']);
    //             $ip = $this->request->getIPAddress();
    //             $useragent = $this->request->getUserAgent();

    //             $log = new \App\Controllers\Services\Logger;
    //             $log->auth(current_user()->id, $ip, $useragent);
    //             return redirect()->to($redirect)
    //                             ->with('info', 'Login berhasil.');
    //         } else {
    //             return redirect()->back()
    //                             ->withInput()
    //                             ->with('error', 'Email atau password salah.');
    //                             // ->with('error', 'Email atau password salah. ' . $ip . ' ' . $useragent);
    //         }
    //     } else {
    //         return redirect()->back()
    //                             ->withInput()
    //                             ->with('error', 'Gagal terverifikasi.');
    //     }
    }

    // public function logout() {
    //     service('auth')->logout();

    //     return redirect()->to('login');
    // }

    // public function forgotPassword() {
    //     return view('Common/forgot_password', [
    //         'time_limit' => $this->linkExpire()
    //     ]);
    // }

    // public function forgotProcess() {
    //     $credential = array(
    //         'secret' => '6Le5VGkeAAAAAFBll9PPU-bDfudulLtrATf_JcZk',
    //         'response' => $this->request->getVar('g-recaptcha-response')
    //     );
    //     $verify = curl_init();
    //     curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    //     curl_setopt($verify, CURLOPT_POST, true);
    //     curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
    //     curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($verify);
    //     $status= json_decode($response, true);

    //     if($this->request->getMethod() == 'post') {
    //         $email = $this->request->getPost('email');
    //         $model = new \App\Models\UsersModel;
    //         $query = $model->findByEmail($email);
    //         if($status['success']) {
    //             if($query == null) {
    //                 return redirect()->back()
    //                             ->with('error', 'Alamat email tidak terdaftar.')
    //                             ->withInput();
    //             } else {
    //                 $url_encrypter = $this->urlEncrypter($email)['full_url'];
    //                 $body = '<p>Hallo, <strong>' . $query->name . '</strong>,</p>' . 
    //                         '<p>Anda telah melakukan request proses reset pasword, silahkan klik link dibawah ini, dan ikuti instruksi setelahnya.</p>' .
    //                         '<p><a href="' . $url_encrypter . '" target="_blank">' . $url_encrypter . '</a></p>'.
    //                         '<p>Link hanya berlaku ' . $this->linkExpire() . ' jam.</p>' .
    //                         '<p>&nbsp;</p>' .
    //                         '<p>MailBlast</p>';
    //                 if($_SERVER['SERVER_NAME'] == 'localhost') {
    //                     $sender_email = env('email.SMTPUser');
    //                 } else {
    //                     $settingmodel = new \App\Models\SettingModel;
    //                     $sender_email = $settingmodel->getValByMark('sender_email')['value'];
    //                 }
    //                 $mail = service('email');
    //                 $mail->setFrom($sender_email, 'Admin mailblast');
    //                 $mail->setSubject('[MailBlast] Lupa password');
    //                 $mail->setMessage($body);
    //                 $mail->setTo($email);
    //                 if($mail->send()) {
    //                     $upd_user = ['forgot_token' => $this->urlEncrypter($email)['encryption']];
    //                     $model->update((int)$query->id, $upd_user);
    //                     return redirect()->back()
    //                             ->with('success', 'Silahkan cek email, dan ikuti instruksi selanjutnya.<br><a href="' . site_url('login') . '">Kembali ke halaman login</a>.');
    //                 } else {
    //                     return redirect()->back()
    //                             ->with('error', 'Maaf, terjadi kesalahan.');
    //                 }
    //             }
    //         } else {
    //             return redirect()->back()
    //                                 ->withInput()
    //                                 ->with('error', 'Gagal terverifikasi.');                
    //         }
    //     }
    // }

    // public function urlEncrypter($email) {
    //     $config = new \Config\Encryption();
    //     $time = Time::now('Asia/Jakarta');

    //     $uri_string = 'email=' . $email . '&date=' . $time->getTimestamp();
    //     $encryption = openssl_encrypt($uri_string, $config->cipher, $config->key, 0, $config->initializationVector);
    //     return ['full_url' => base_url() . '/requestResetPassword?' . urlencode($encryption), 'encryption' => $encryption];

    // }

    // public function requestResetPassword() {
    //     try {
    //         $config = new \Config\Encryption();
    //         $encrypter = \Config\Services::encrypter($config);
    //         $model = new \App\Models\UsersModel;
    //         $string = rawurldecode(substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "?") + 1));
    //         $decryption = openssl_decrypt($string, $config->cipher, $config->key, 0, $config->initializationVector);
    //         $sub1 = explode('&', $decryption);
    //         if(count($sub1) > 0) {
    //             foreach($sub1 as $s) {
    //                 $parse = explode('=', $s);
    //             }
    //             $email_part = explode('=', $sub1[0]);
    //             $email = $email_part[1];
    //             $timestamp_part = explode('=', $sub1[1]);
    //             $timestamp = $timestamp_part[1];

    //             $timestamp_convert = Time::createFromTimestamp($timestamp);
    //             $time =  $timestamp_convert->setTimezone('Asia/Jakarta');
    //             $current = Time::now();
    //             $test = Time::parse($time, 'Asia/Jakarta');
    //             $diff = $current->difference($test);
                
    //             $timelimit = $diff->getMinutes();
    //             $query = $model->findByEmail($email);
    //             // Link berlaku 24 jam (24x60=1440)

    //             $link_expire = $this->linkExpire(true);

    //             if($query !== null && $timelimit >= -$link_expire) {
    //                 if($query->forgot_token == '0') {
    //                     session()->setFlashdata('error_new_passwd', 'Maaf, link ini sudah digunakan.');
    //                     return view('Common/new_password');    
    //                 }
    //                 return view('Common/new_password', [
    //                     'uid' => $query->id,
    //                     'enc' => $string
    //                 ]);
    //             } else {
    //                 session()->setFlashdata('error_new_passwd', 'Maaf, link sudah kadaluarsa.');
    //                 return view('Common/new_password');
    //             }
    //         } else {
    //             session()->setFlashdata('error_new_passwd', 'Maaf, link tidak dikenal.');
    //             return view('Common/new_password');
    //         }
    //     } catch(Exception $e) {
    //         session()->setFlashdata('error_new_passwd', $e->getMessage());
    //         return view('Common/new_password');
    //     }
    // }

    // private function linkExpire($in_minute = false)
    // {
    //     $common_lib = new Common;
    //     $link_expire = $common_lib->linkUrlExpire();

    //     if($in_minute) {
    //         return (int)$link_expire * 60;
    //     }

    //     return $link_expire;
    // }

    // public function newPasswordStore() {
    //     $model = new \App\Models\UsersModel;
    //     $entity = new \App\Entities\User([
    //         'password' => $this->request->getPost('password'),
    //         'password_confirmation' => $this->request->getPost('password_confirmation'),
    //         'forgot_token' => '0'
    //     ]);
    //     if($model->update($this->request->getPost('uid'), $entity)) {
    //         return redirect()->to('login')->with('change_passwd_success', 'Password berhasil diubah.');
    //     } else {
    //         return redirect()->back()->with('error_form', 'Terjadi kesalahan. Pastikan form diisi dengan benar.');
    //     }
    // }
}
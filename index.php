<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalori Hesaplama & Kilo Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .section-title { font-size: 1.3rem; font-weight: 700; color: #007bff; margin-bottom: 12px; }
        .result-box { background: #f8fafd; border-radius: 16px; padding: 18px 16px; margin-bottom: 18px; box-shadow: 0 2px 8px 0 rgba(0,60,120,0.06); }
        .result-icon { font-size: 1.6rem; margin-right: 8px; vertical-align: middle; }
        .motivation { font-size: 1.1rem; font-weight: 500; color: #00b894; }
        .social-icons a { color: #007bff; margin: 0 8px; font-size: 1.3rem; transition: color 0.2s; }
        .social-icons a:hover { color: #00c6ff; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-4">
                <h1 class="display-5 fw-bold text-primary"><i class="fa-solid fa-fire-flame-curved"></i> Kalori Hesaplama & Kilo Yönetimi</h1>
                <p class="lead">Günlük kalori ihtiyacınızı, vücut kitle indeksinizi, yağ oranınızı ve hedefinize göre önerilen kaloriyi öğrenin.</p>
            </div>
            <div class="alert alert-info mb-4">
                <strong><i class="fa-solid fa-circle-info"></i> Bilgi:</strong> Hesaplamalar Mifflin-St Jeor, US Navy vücut yağ oranı ve genel sağlık formüllerine dayanmaktadır. Sonuçlar bilgilendirme amaçlıdır.
            </div>
            <div class="card shadow-lg">
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="age" class="form-label">Yaş</label>
                                <input type="number" class="form-control" id="age" name="age" min="10" max="100" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="gender" class="form-label">Cinsiyet</label>
                                <select class="form-select" id="gender" name="gender" required onchange="toggleHipField()">
                                    <option value="">Seçiniz</option>
                                    <option value="male">Erkek</option>
                                    <option value="female">Kadın</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="activity" class="form-label">Aktivite Seviyesi</label>
                                <select class="form-select" id="activity" name="activity" required>
                                    <option value="1.2">Hareketsiz</option>
                                    <option value="1.375">Az Aktif</option>
                                    <option value="1.55">Orta Aktif</option>
                                    <option value="1.725">Çok Aktif</option>
                                    <option value="1.9">Aşırı Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="goal" class="form-label">Hedefiniz</label>
                                <select class="form-select" id="goal" name="goal" required>
                                    <option value="lose">Kilo Vermek</option>
                                    <option value="maintain">Kilo Korumak</option>
                                    <option value="gain">Kilo Almak</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="height" class="form-label">Boy (cm)</label>
                                <input type="number" class="form-control" id="height" name="height" min="100" max="250" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="weight" class="form-label">Kilo (kg)</label>
                                <input type="number" class="form-control" id="weight" name="weight" min="30" max="250" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="waist" class="form-label">Bel (cm)</label>
                                <input type="number" class="form-control" id="waist" name="waist" min="40" max="200" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="neck" class="form-label">Boyun (cm)</label>
                                <input type="number" class="form-control" id="neck" name="neck" min="20" max="80" required>
                            </div>
                            <div class="col-md-2 mb-3" id="hipField" style="display:none;">
                                <label for="hip" class="form-label">Kalça (cm)</label>
                                <input type="number" class="form-control" id="hip" name="hip" min="40" max="200">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="target_weight" class="form-label">Hedef Kilo (kg)</label>
                                <input type="number" class="form-control" id="target_weight" name="target_weight" min="30" max="250" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="water" class="form-label">Günlük Su (litre)</label>
                                <input type="number" class="form-control" id="water" name="water" min="1" max="10" step="0.1" placeholder="Otomatik hesaplanır" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="sleep" class="form-label">Önerilen Uyku (saat)</label>
                                <input type="number" class="form-control" id="sleep" name="sleep" min="5" max="12" step="0.1" placeholder="Otomatik hesaplanır" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="weights" class="form-label">Son 5 Kilonuz (virgülle ayırın)</label>
                                <input type="text" class="form-control" id="weights" name="weights" placeholder="Örn: 85,84,83,82,81">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-calculator"></i> Hesapla</button>
                    </form>
                    <script>
                        function toggleHipField() {
                            var gender = document.getElementById('gender').value;
                            document.getElementById('hipField').style.display = (gender === 'female') ? 'block' : 'none';
                        }
                        // Su ve uyku otomatik hesaplama
                        document.getElementById('weight').addEventListener('input', function() {
                            var kg = parseFloat(this.value);
                            if (!isNaN(kg)) {
                                document.getElementById('water').value = (kg * 0.033).toFixed(2);
                            }
                        });
                        document.getElementById('age').addEventListener('input', function() {
                            var age = parseInt(this.value);
                            var sleep = 8;
                            if (age < 18) sleep = 9;
                            else if (age < 65) sleep = 7.5;
                            else sleep = 7;
                            document.getElementById('sleep').value = sleep;
                        });
                    </script>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $age = (int)$_POST['age'];
                        $gender = $_POST['gender'];
                        $height = (int)$_POST['height'];
                        $weight = (int)$_POST['weight'];
                        $activity = (float)$_POST['activity'];
                        $goal = isset($_POST['goal']) ? $_POST['goal'] : '';
                        $waist = isset($_POST['waist']) ? (float)$_POST['waist'] : 0;
                        $neck = isset($_POST['neck']) ? (float)$_POST['neck'] : 0;
                        $hip = isset($_POST['hip']) ? (float)$_POST['hip'] : 0;
                        $target_weight = isset($_POST['target_weight']) ? (float)$_POST['target_weight'] : 0;
                        $weights = isset($_POST['weights']) ? $_POST['weights'] : '';
                        // BMR Hesaplama (Mifflin-St Jeor)
                        if ($gender === 'male') {
                            $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
                        } else {
                            $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
                        }
                        $tdee = $bmr * $activity;
                        // Hedefe göre kalori
                        if ($goal === 'lose') {
                            $target_cal = $tdee - 500;
                            $goal_text = 'Kilo Vermek';
                            $desc = 'Haftada yaklaşık 0.5 kg kaybı için önerilen değer.';
                        } elseif ($goal === 'gain') {
                            $target_cal = $tdee + 400;
                            $goal_text = 'Kilo Almak';
                            $desc = 'Haftada yaklaşık 0.5 kg artışı için önerilen değer.';
                        } else {
                            $target_cal = $tdee;
                            $goal_text = 'Kilo Korumak';
                            $desc = 'Mevcut kilonuzu korumak için önerilen değer.';
                        }
                        // VKİ Hesaplama
                        $height_m = $height / 100;
                        $bmi = $weight / ($height_m * $height_m);
                        if ($bmi < 18.5) {
                            $bmi_status = 'Zayıf';
                            $bmi_color = 'info';
                        } elseif ($bmi < 25) {
                            $bmi_status = 'Normal';
                            $bmi_color = 'success';
                        } elseif ($bmi < 30) {
                            $bmi_status = 'Fazla Kilolu';
                            $bmi_color = 'warning';
                        } else {
                            $bmi_status = 'Obez';
                            $bmi_color = 'danger';
                        }
                        // Vücut Yağ Oranı (US Navy)
                        if ($gender === 'male') {
                            $bodyfat = 495 / (1.0324 - 0.19077 * log10($waist - $neck) + 0.15456 * log10($height)) - 450;
                        } else {
                            $bodyfat = 495 / (1.29579 - 0.35004 * log10($waist + $hip - $neck) + 0.22100 * log10($height)) - 450;
                        }
                        $bodyfat = max(0, min(60, $bodyfat));
                        $lbm = $weight * (1 - $bodyfat / 100);
                        // Makro Hesaplama (örnek: %30 protein, %30 yağ, %40 karbonhidrat)
                        $protein = round($weight * 1.8); // gram
                        $fat = round($weight * 0.9); // gram
                        $carb = round(($target_cal - ($protein * 4 + $fat * 9)) / 4); // gram
                        // Hedefe ulaşma süresi
                        $weight_diff = abs($weight - $target_weight);
                        if ($goal === 'lose') {
                            $weeks = $weight > $target_weight ? round($weight_diff / 0.5) : 0;
                        } elseif ($goal === 'gain') {
                            $weeks = $weight < $target_weight ? round($weight_diff / 0.5) : 0;
                        } else {
                            $weeks = 0;
                        }
                        // WHR (Bel/Kalça Oranı)
                        if ($hip > 0) {
                            $whr = round($waist / $hip, 2);
                            if ($gender === 'female') {
                                if ($whr < 0.8) $whr_comment = 'Düşük risk';
                                elseif ($whr < 0.85) $whr_comment = 'Orta risk';
                                else $whr_comment = 'Yüksek risk';
                            } else {
                                if ($whr < 0.95) $whr_comment = 'Düşük risk';
                                elseif ($whr < 1.0) $whr_comment = 'Orta risk';
                                else $whr_comment = 'Yüksek risk';
                            }
                        } else {
                            $whr = '-';
                            $whr_comment = 'Veri girilmedi';
                        }
                        // İdeal kilo aralığı (Devine formülü ve BMI 18.5-24.9)
                        if ($gender === 'male') {
                            $ideal_min = 18.5 * $height_m * $height_m;
                            $ideal_max = 24.9 * $height_m * $height_m;
                            $devine = 50 + 2.3 * (($height / 2.54) - 60);
                        } else {
                            $ideal_min = 18.5 * $height_m * $height_m;
                            $ideal_max = 24.9 * $height_m * $height_m;
                            $devine = 45.5 + 2.3 * (($height / 2.54) - 60);
                        }
                        // Motivasyon mesajı
                        $motivation = [
                            'Her gün küçük adımlar büyük değişimler yaratır!',
                            'Sağlıklı yaşam bir yolculuktur, varış noktası değil.',
                            'Kendin için en iyisini yapmaya devam et!',
                            'Başarı, istikrarlı alışkanlıklarla gelir.',
                            'Bugün attığın adım, yarının sağlığıdır.',
                            'Senin için imkansız yok!',
                            'Küçük değişiklikler büyük sonuçlar doğurur.',
                            'Her yeni gün yeni bir başlangıçtır.'
                        ];
                        $motivation_msg = $motivation[array_rand($motivation)];
                        $water = round($weight * 0.033, 2);
                        $sleep = ($age < 18) ? 9 : (($age < 65) ? 7.5 : 7);
                        echo '<hr class="section">';
                        echo '<div class="row g-3">';
                        echo '<div class="col-md-4"><div class="result-box"><span class="result-title"><i class="fa-solid fa-bolt result-icon"></i>BMR (Bazal Metabolizma)</span><br><b>' . round($bmr) . ' kcal</b><br><small>Dinlenme halinde harcanan enerji</small></div></div>';
                        echo '<div class="col-md-4"><div class="result-box"><span class="result-title"><i class="fa-solid fa-fire result-icon"></i>TDEE (Toplam Enerji)</span><br><b>' . round($tdee) . ' kcal</b><br><small>Günlük toplam enerji ihtiyacı</small></div></div>';
                        echo '<div class="col-md-4"><div class="result-box"><span class="result-title"><i class="fa-solid fa-bullseye result-icon"></i>Hedef Kalori</span><br><b>' . round($target_cal) . ' kcal</b><br><small>' . $desc . '</small></div></div>';
                        echo '</div>';
                        echo '<div class="row g-3 mt-2">';
                        echo '<div class="col-md-3"><div class="result-box"><span class="result-title"><i class="fa-solid fa-ruler result-icon"></i>VKİ</span><br><b>' . round($bmi, 1) . '</b> <span class="badge bg-' . $bmi_color . '">' . $bmi_status . '</span></div></div>';
                        echo '<div class="col-md-3"><div class="result-box"><span class="result-title"><i class="fa-solid fa-percent result-icon"></i>Yağ Oranı</span><br><b>' . round($bodyfat, 1) . ' %</b><br><small>Yağsız Kütle: ' . round($lbm, 1) . ' kg</small></div></div>';
                        echo '<div class="col-md-3"><div class="result-box"><span class="result-title"><i class="fa-solid fa-arrows-left-right result-icon"></i>WHR (Bel/Kalça)</span><br><b>' . $whr . '</b><br><small>' . $whr_comment . '</small></div></div>';
                        echo '<div class="col-md-3"><div class="result-box"><span class="result-title"><i class="fa-solid fa-weight-scale result-icon"></i>İdeal Kilo</span><br><b>' . round($ideal_min) . ' - ' . round($ideal_max) . ' kg</b><br><small>Devine: ' . round($devine) . ' kg</small></div></div>';
                        echo '</div>';
                        echo '<div class="row g-3 mt-2">';
                        echo '<div class="col-md-4"><div class="result-box"><span class="result-title"><i class="fa-solid fa-drumstick-bite result-icon"></i>Protein</span><br><b>' . $protein . 'g</b></div></div>';
                        echo '<div class="col-md-4"><div class="result-box"><span class="result-title"><i class="fa-solid fa-bacon result-icon"></i>Yağ</span><br><b>' . $fat . 'g</b></div></div>';
                        echo '<div class="col-md-4"><div class="result-box"><span class="result-title"><i class="fa-solid fa-bread-slice result-icon"></i>Karbonhidrat</span><br><b>' . $carb . 'g</b></div></div>';
                        echo '</div>';
                        if ($weeks > 0) {
                            echo '<div class="alert alert-secondary mt-3"><i class="fa-solid fa-hourglass-half"></i> <strong>Tahmini Süre:</strong> Hedef kilonuza ulaşmak için yaklaşık <b>' . $weeks . ' hafta</b> gereklidir.</div>';
                            // Günlük ve haftalık kilo kaybı, kalori açığı ve öneriler
                            $total_kg = abs($weight - $target_weight);
                            $weekly_kg = $weeks > 0 ? round($total_kg / $weeks, 2) : 0;
                            $daily_kg = $weeks > 0 ? round($total_kg / ($weeks * 7), 3) : 0;
                            $calorie_deficit = 7700 * $weekly_kg / 7; // 1 kg yağ = ~7700 kcal
                            echo '<div class="alert alert-info">';
                            echo '<b>Detaylı Hedef Analizi</b><br>';
                            echo 'Hedefinize ulaşmak için <b>günde ortalama ' . $daily_kg . ' kg</b> (' . $weekly_kg . ' kg/hafta) kaybetmelisiniz.';
                            echo '<br>Bu da yaklaşık <b>günde ' . round($calorie_deficit) . ' kcal</b> kalori açığı oluşturmanız gerektiği anlamına gelir.';
                            echo '<ul class="mt-2 mb-1">';
                            echo '<li>Her gün 500-1000 kcal arası bir açık sağlıklı kabul edilir (haftada 0.5-1 kg kayıp).</li>';
                            echo '<li>Kalori açığını hem beslenme hem de egzersizle oluşturmak en sağlıklısıdır.</li>';
                            echo '<li>Yeterli protein ve su tüketimi, kas kaybını önler ve tokluk sağlar.</li>';
                            echo '<li>Uyku ve stres yönetimi de kilo verme sürecini etkiler.</li>';
                            echo '</ul>';
                            echo '<div class="small text-muted">Unutma: Çok hızlı kilo kaybı sağlıksızdır. Haftada 0.5-1 kg arası kayıp idealdir. Hedefine ulaşırken sabırlı ol!</div>';
                            echo '</div>';
                        }
                        echo '<div class="row g-3 mt-2">';
                        echo '<div class="col-md-6"><div class="result-box"><span class="result-title"><i class="fa-solid fa-droplet result-icon"></i>Günlük Su İhtiyacı</span><br><b>' . $water . ' L</b></div></div>';
                        echo '<div class="col-md-6"><div class="result-box"><span class="result-title"><i class="fa-solid fa-bed result-icon"></i>Önerilen Uyku</span><br><b>' . $sleep . ' saat</b></div></div>';
                        echo '</div>';
                        echo '<div class="motivation my-3"><i class="fa-solid fa-heart"></i> ' . $motivation_msg . '</div>';
                        echo '<div class="alert alert-light mt-3"><strong>VKİ Açıklaması:</strong><br>
                        <ul class="mb-0">
                            <li><strong>18.5 altı:</strong> Zayıf</li>
                            <li><strong>18.5 - 24.9:</strong> Normal</li>
                            <li><strong>25 - 29.9:</strong> Fazla Kilolu</li>
                            <li><strong>30 ve üzeri:</strong> Obez</li>
                        </ul></div>';
                        echo '<div class="alert alert-light"><strong>Makro Besinler:</strong> Protein, yağ ve karbonhidrat oranları örnek olarak hesaplanmıştır. Kişisel ihtiyaçlarınız için diyetisyene danışınız.</div>';
                        echo '<div class="alert alert-light"><strong>Vücut Yağ Oranı:</strong> US Navy formülüne göre tahmini olarak hesaplanır. En doğru sonuç için profesyonel ölçüm yaptırınız.</div>';
                        echo '<div class="alert alert-light"><strong>Sağlık Önerisi:</strong> Dengeli beslenme, düzenli egzersiz ve yeterli uyku sağlıklı yaşamın anahtarıdır.</div>';
                        echo '<div class="row g-3 mt-2">';
                        // Besin Raporu
                        echo '<div class="col-md-6"><div class="result-box">';
                        echo '<span class="result-title"><i class="fa-solid fa-utensils"></i> Besin Raporu (Örnek Günlük Plan)</span>';
                        echo '<ul class="mb-2">';
                        echo '<li><b>Kahvaltı:</b> 2 haşlanmış yumurta, 1 dilim tam buğday ekmeği, 1 dilim beyaz peynir, domates-salatalık, 5 zeytin</li>';
                        echo '<li><b>Ara Öğün:</b> 1 orta boy elma, 10 badem</li>';
                        echo '<li><b>Öğle:</b> 120g ızgara tavuk, 5 kaşık bulgur pilavı, bol salata, 1 kase yoğurt</li>';
                        echo '<li><b>Ara Öğün:</b> 1 kutu kefir, 1 muz</li>';
                        echo '<li><b>Akşam:</b> 120g ızgara balık veya et, 1 dilim tam buğday ekmeği, zeytinyağlı sebze yemeği, yoğurt</li>';
                        echo '</ul>';
                        echo '<div class="small text-muted">Toplam: Yaklaşık ' . round($target_cal) . ' kcal | Protein: ' . $protein . 'g | Yağ: ' . $fat . 'g | Karbonhidrat: ' . $carb . 'g</div>';
                        echo '</div></div>';
                        // Spor Raporu
                        echo '<div class="col-md-6"><div class="result-box">';
                        echo '<span class="result-title"><i class="fa-solid fa-dumbbell"></i> Spor Raporu (Örnek Haftalık Plan)</span>';
                        echo '<ul class="mb-2">';
                        if ($activity < 1.4) {
                            echo '<li><b>Pazartesi:</b> 30 dk tempolu yürüyüş</li>';
                            echo '<li><b>Çarşamba:</b> 30 dk tempolu yürüyüş</li>';
                            echo '<li><b>Cuma:</b> 30 dk tempolu yürüyüş</li>';
                            echo '<li><b>Her gün:</b> 10 dk esneme/germe</li>';
                        } elseif ($activity < 1.7) {
                            echo '<li><b>Pazartesi:</b> 40 dk kardiyo (koşu/bisiklet)</li>';
                            echo '<li><b>Salı:</b> Tüm vücut kuvvet antrenmanı</li>';
                            echo '<li><b>Perşembe:</b> 40 dk kardiyo</li>';
                            echo '<li><b>Cumartesi:</b> Tüm vücut kuvvet antrenmanı</li>';
                            echo '<li><b>Her gün:</b> 10 dk esneme/germe</li>';
                        } else {
                            echo '<li><b>Pazartesi:</b> Üst vücut kuvvet + 30 dk kardiyo</li>';
                            echo '<li><b>Salı:</b> Alt vücut kuvvet + 20 dk HIIT</li>';
                            echo '<li><b>Çarşamba:</b> 45 dk kardiyo</li>';
                            echo '<li><b>Perşembe:</b> Tüm vücut kuvvet</li>';
                            echo '<li><b>Cuma:</b> 30 dk kardiyo + core</li>';
                            echo '<li><b>Cumartesi:</b> Aktif dinlenme (yoga, pilates, yürüyüş)</li>';
                            echo '<li><b>Pazar:</b> Dinlenme</li>';
                        }
                        echo '</ul>';
                        echo '<div class="small text-muted">Egzersizler hedefinize ve seviyenize göre örneklenmiştir. Sağlık durumunuza göre kişiselleştirin.</div>';
                        echo '</div></div>';
                        echo '</div>';
                        // 1) Vücut Tipi ve Risk Uyarısı
                        $vucut_tipi = '';
                        if ($bmi < 18.5) $vucut_tipi = 'Zayıf';
                        elseif ($bmi < 25) $vucut_tipi = 'Normal';
                        elseif ($bmi < 30) $vucut_tipi = 'Fazla Kilolu';
                        else $vucut_tipi = 'Obez';
                        $risk = '';
                        if ($whr !== '-' && is_numeric($whr)) {
                            if ($gender === 'female') {
                                if ($whr < 0.8) $risk = 'Düşük risk';
                                elseif ($whr < 0.85) $risk = 'Orta risk';
                                else $risk = 'Yüksek risk';
                            } else {
                                if ($whr < 0.95) $risk = 'Düşük risk';
                                elseif ($whr < 1.0) $risk = 'Orta risk';
                                else $risk = 'Yüksek risk';
                            }
                        }
                        echo '<div class="result-box mt-3"><span class="result-title"><i class="fa-solid fa-user-shield"></i> Vücut Tipi & Sağlık Riski</span>';
                        echo '<div><b>Vücut Tipi:</b> ' . $vucut_tipi . ' | <b>WHR Sağlık Riski:</b> ' . ($risk ? $risk : 'Veri yok') . '</div>';
                        if ($vucut_tipi === 'Obez' || $risk === 'Yüksek risk') {
                            echo '<div class="text-danger mt-2"><b>Uyarı:</b> Sağlık riskiniz yüksek olabilir. Lütfen bir uzmana danışın.</div>';
                        }
                        echo '</div>';
                        // 2) Motivasyonel Sözler (her hesaplamada yeni bir tane)
                        $motivation_quotes = [
                            'Başarı, küçük adımların toplamıdır.',
                            'Bugün attığın adım, yarının sağlığıdır.',
                            'Vazgeçmek yok, devam!',
                            'Her yeni gün yeni bir başlangıçtır.',
                            'Küçük değişiklikler büyük sonuçlar doğurur.',
                            'Senin için imkansız yok!',
                            'Kendin için en iyisini yapmaya devam et!',
                            'Sağlıklı yaşam bir yolculuktur, varış noktası değil.'
                        ];
                        $motivation_today = $motivation_quotes[array_rand($motivation_quotes)];
                        echo '<div class="alert alert-success mt-3"><i class="fa-solid fa-star"></i> <b>Motivasyon:</b> ' . $motivation_today . '</div>';
                        // 3) Vitamin/Mineral Tablosu
                        echo '<div class="result-box mt-3"><span class="result-title"><i class="fa-solid fa-apple-whole"></i> Temel Vitamin & Mineral İhtiyacı (Günlük)</span>';
                        echo '<table class="table table-sm table-bordered mt-2 mb-0" style="background:#fff;border-radius:12px;overflow:hidden;">';
                        echo '<thead><tr><th>Besin</th><th>Önerilen</th></tr></thead><tbody>';
                        echo '<tr><td>C Vitamini</td><td>75-90 mg</td></tr>';
                        echo '<tr><td>D Vitamini</td><td>600 IU</td></tr>';
                        echo '<tr><td>Kalsiyum</td><td>1000 mg</td></tr>';
                        echo '<tr><td>Demir</td><td>8-18 mg</td></tr>';
                        echo '<tr><td>Magnezyum</td><td>300-400 mg</td></tr>';
                        echo '<tr><td>B12 Vitamini</td><td>2.4 mcg</td></tr>';
                        echo '</tbody></table>';
                        echo '<div class="small text-muted mt-1">Kişisel ihtiyaçlarınız için doktorunuza danışınız.</div>';
                        echo '</div>';
                        // 4) Başarı Rozeti
                        if ($weight > $target_weight && $total_kg > 0) {
                            $progress = ($weight - $target_weight) / $total_kg;
                            if ($progress <= 0.5) {
                                echo '<div class="alert alert-warning mt-3"><i class="fa-solid fa-medal"></i> <b>Tebrikler!</b> Hedefinin %50\'sine ulaştın, harika gidiyorsun!</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <footer class="text-center mt-4 text-muted small fixed-bottom pb-2" style="background:transparent;box-shadow:none;">
                <span>&copy; 2025 Kalori Hesaplama Scripti | Dijital Danışmanın Tarafından Oluşturuldu</span>
            </footer>
        </div>
    </div>
</div>
</body>
</html> 
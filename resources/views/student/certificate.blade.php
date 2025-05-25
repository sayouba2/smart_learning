<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificat de réussite - {{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap');
        
        body { 
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        
        .certificate-container { 
            border: 20px solid #3a0ca3;
            border-image: linear-gradient(135deg, #4361ee, #3a0ca3) 30;
            padding: 60px;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .watermark {
            position: absolute;
            opacity: 0.1;
            font-size: 180px;
            font-weight: bold;
            color: #4361ee;
            transform: rotate(-30deg);
            z-index: 0;
            top: 30%;
            left: 10%;
            pointer-events: none;
        }
        
        .header { 
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }
        
        .app-name {
            font-size: 14px;
            color: #6c757d;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .title { 
            color: #3a0ca3; 
            font-size: 42px; 
            font-family: 'Playfair Display', serif;
            margin: 10px 0;
        }
        
        .subtitle {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 30px;
        }
        
        .divider {
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, #4361ee, #4cc9f0);
            margin: 30px auto;
        }
        
        .student-name { 
            font-size: 32px; 
            margin: 25px 0; 
            font-weight: 600;
            color: #212529;
        }
        
.signature-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-top: 80px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.signature-left, .signature-right {
    width: 45%;
}

.signature-left {
    text-align: left;
}

.signature-right {
    text-align: right;
}

.signature-image {
    height: 80px;
    margin-bottom: 15px;
}

.signature-line {
    border-top: 1px solid #212529;
    width: 200px;
    margin-bottom: 10px;
}

.signature-left .signature-line {
    margin-left: 0;
    margin-right: auto;
}

.signature-right .signature-line {
    margin-left: auto;
    margin-right: 0;
}

.signature-title {
    font-weight: 600;
    margin-bottom: 5px;
}

.signature-name {
    font-style: italic;
}



        .course-name { 
            font-size: 24px; 
            font-weight: 600;
            color: #4361ee;
            margin-bottom: 15px;
        }
        
        .date { 
            margin-top: 40px;
            font-size: 16px;
            color: #6c757d;
        }
        
        
        .signature-image {
            height: 80px;
            margin-bottom: 15px;
        }

        .certificate-id {
            font-size: 12px;
            color: #adb5bd;
            margin-top: 40px;
        }
        
        .seal {
            position: absolute;
            right: 50px;
            top: 50px;
            width: 100px;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- Filigrane -->
        
        
        <!-- Sceau -->
      
        
        <!-- En-tête -->
        <div class="header">
            <div class="app-name">{{ config('app.name') }}</div>
            <h1 class="title">Certificat de Completion</h1>
            <div class="subtitle">Accordé avec distinction</div>
            <div class="divider"></div>
        </div>
        
        <!-- Corps du certificat -->
        <p>Ce certificat est décerné à</p>
        <div class="student-name">{{ $user->name }}</div>
        
        <p>pour avoir complété avec succès le cours</p>
        <div class="course-name">{{ $course->title }}</div>
        
        <div class="date">
            <p>Date d'obtention: {{ $date }}</p>
        </div>
        
 <table width="100%" style="margin-top: 80px; padding-top: 20px; border-top: 1px solid #e9ecef;">
    <tr>
        <td style="width: 50%; text-align: left; padding-left: 10px;">
            <div class="signature-line" style="margin-left: 0;"></div>
            <div class="signature-title">Directeur Académique</div>
            <div class="signature-name">OUEDRAOGO Sayouba</div>
        </td>
        <td style="width: 50%; text-align: right; padding-right: 10px;">
            <div class="signature-line" style="margin-left: auto; margin-right: 0;"></div>
            <div class="signature-title">Enseignant</div>
            <div class="signature-name">{{ $course->teacher->name }}</div>
        </td>
    </tr>
</table>


        
        <!-- ID unique -->
        <div class="certificate-id">
            Certificat ID: {{ strtoupper(uniqid()) }} | Émis le: {{ now()->format('Y-m-d') }}
        </div>
    </div>
</body>
</html>
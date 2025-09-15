<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    #img1{
        width: 100%;
        height: 100vh;
        object-fit: cover;
        display: block;
    }
    .nav{
        width: 100%;
        height: 60px;
        background-color: #000;
        color: #fff;
        display: flex;
        align-items: center;
        padding-left: 20px;
        font-family: Arial, sans-serif;
        
    }

    h2{
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
        margin: 0;
        color: #fff;
        border: 5px solid #fff;
        border-radius: 8px;
    }
    .welcome-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        background: rgba(0,0,0,0.5);
        padding: 40px 60px;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    }
    .welcome-title {
        color: #fff;
        font-size: 2.5rem;
        margin-bottom: 32px;
        font-family: 'Arial Black', Arial, sans-serif;
        text-shadow: 2px 2px 8px #000;
    }
    .animated-btn {
        display: inline-block;
        padding: 16px 40px;
        font-size: 1.2rem;
        color: #fff;
        background: linear-gradient(90deg, #ff9800, #ff5722);
        border: none;
        border-radius: 30px;
        text-decoration: none;
        font-weight: bold;
        box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        transition: transform 0.2s, box-shadow 0.2s, background 0.4s;
        cursor: pointer;
        animation: pulse 1.5s infinite;
    }
    .animated-btn:hover {
        transform: scale(1.08);
        box-shadow: 0 8px 32px rgba(255,152,0,0.3);
        background: linear-gradient(90deg, #ff5722, #ff9800);
        animation: none;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(255,152,0,0.7); }
        70% { box-shadow: 0 0 0 16px rgba(255,152,0,0); }
        100% { box-shadow: 0 0 0 0 rgba(255,152,0,0); }
    }
</style>
<body>
    <div class="nav">
        <h2>OurinhosTour</h2>
    </div>
    <img src="imagens/welcome_img1.png" id="img1" />
    <div class="welcome-container">
        <h1 class="welcome-title">Bem-vindo a Ourinhos!</h1>
        <a href="index.php" class="animated-btn">Entrar no site</a>
    </div>
    
</body>
</html>
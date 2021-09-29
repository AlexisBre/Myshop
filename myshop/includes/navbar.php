<div class="mobile-container" >

    <nav class="navbar navbar-light  navbar-expand-md p-0  ">
        <a class="navbar-brand pt-0" href="index.php">
          <img alt="Logo_page" id="logo" width=90px src="https://image.freepik.com/vecteurs-libre/chien-bouledogue-francais-dessin-anime-caractere-illustration_71328-827.jpg"></a>

    <button  type="button" class="navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#navbarContent" >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav" >
        <li class="nav-item justify-content-start">
            <a class="nav-link <?php if ($page=='index'){echo 'active';} ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($page=="alimentation"){echo 'active';} ?>" href="alimentation.php">Alimentation</a>

        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($page=="balade"){echo 'active';} ?>" href="balade.php">Balade</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($page=="couchage"){echo 'active';} ?>" href="couchage.php">Couchage</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($page=="hygiene"){echo 'active';} ?>" href="hygiene.php">Hygiene</a>

        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($page=="contact"){echo 'active';} ?>" href="contact.php">Contacts</a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto w-100 justify-content-end container" >
        <li class="nav-item" >
            <a class="nav-link me-0 pe-0" id="login" href="signin.php">Login</a>
        </li>
        </ul>

    </div>
        <a href="#shoppingcart" class="cart-icon"  ><img id="cart" class="position-relative" alt="Add to cart" src="images/cart-button.png"></a>

    </nav>

</div>

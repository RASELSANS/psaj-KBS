<style>
    .artikel-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    .blog-card { border: none; border-radius: 20px; transition: 0.3s; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .blog-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2); }
    .text-orange { color: #ff8a3d; }
    .btn-read-more { color: #ff8a3d; font-weight: 600; text-decoration: none; font-size: 0.9rem; }
</style>

<section class="artikel-header">
    <div class="container">
        <h1 class="fw-bold">Login Admin</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">       
            <form action="/api/admin/login" method="POST">
                <?= csrf_field() ?>
                <label for="username">Username</label>
                <input type="text" name="username">

                <label for="password">Password</label>
                <input type="password" name="password">

                <button type="submit">Log In</button>
            </form>
        </div>
    </div>
</section>

<script>

</script>
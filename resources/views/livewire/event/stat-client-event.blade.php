<div class="spm-settings-panel">

    <div class="stats-container">

        <!-- STATUS EVENT -->
        <div class="stat-card upcoming">
            <div class="icon">
                <i class="las la-calendar-alt"></i>
            </div>

            <div class="content">
                <h3>{{ ucfirst($status ?? 'N/A') }}</h3>
                <p>Statut de l’événement</p>
            </div>
        </div>

        <!-- GUESTS -->
        <div class="stat-card ongoing">
            <div class="icon">
                <i class="las la-users"></i>
            </div>

            <div class="content">
                <h3>{{ $guestsCount }}</h3>
                <p>Invités</p>
            </div>
        </div>

        <!-- PRODUCTS -->
        <div class="stat-card past">
            <div class="icon">
                <i class="las la-box"></i>
            </div>

            <div class="content">
                <h3>{{ $productsCount }}</h3>
                <p>Produits liés</p>
            </div>
        </div>

    </div>

</div>
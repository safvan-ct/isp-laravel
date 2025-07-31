@extends('layouts.web')

@section('content')
    <header class="header">
        <h1>ഇസ്ലാമിക് സ്റ്റഡി പോർട്ടൽ</h1>
        <p>ഈ പോർട്ടൽ വഴി ഇസ്ലാമിക വിദ്യാഭ്യാസം ആഴത്തിൽ പഠിക്കാം</p>
    </header>

    <main class="container my-3">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">📖 Quran | ഖുർആൻ പഠനം</h5>
                        <p class="card-text">ഖുർആൻ ആയത്തുകൾ, അർഥം, തഫ്സീർ, ഓഡിയോ</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="{{ route('quran.index') }}" class="btn btn-primary">പഠിക്കാൻ തുടങ്ങൂ</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">🕋 Hadith | ഹദീസ്</h5>
                        <p class="card-text">ബുഖാരി, മുസ്ലിം, മറ്റു സഹീഹ് ഹദീഥുകൾ മലയാളത്തിലേക്ക്</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="hadith.html" class="btn btn-primary">കാണുക</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">🧼 Death | മരണം</h5>
                        <p class="card-text">മയ്യിത്ത് കുളിപ്പിക്കൽ, കഫൻ, നമസ്‌കാരം, ഖബർ</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="life-list.html?id=6" class="btn btn-primary">വിവരങ്ങൾ കാണുക</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">📚 Islamic History | ഇസ്ലാമിക ചരിത്രം</h5>
                        <p class="card-text">നബി ജീവിതം, ഖുലഫാ റാശിദൂൻ, കലിഫാക്കൾ</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="#" class="btn btn-primary">പഠിക്കുക</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">👨‍👩‍👧 Family Guidance | കുടുംബശാസ്ത്രം</h5>
                        <p class="card-text">വിവാഹം, കുട്ടികളുടെ ലാലനം, കുടുംബ ജീവിതം</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="#" class="btn btn-primary">കൂടുതൽ കാണുക</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">📅 Islamic Calendar | ഇസ്‌ലാമിക് കലണ്ടർ</h5>
                        <p class="card-text">ഇസ്‌ലാമിക് ദിവസങ്ങൾ, റമളാൻ, ഹജ്ജ്</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="#" class="btn btn-primary">ദിവസങ്ങൾ കാണുക</a>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

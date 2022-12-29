<ul class="metismenu" id="menu">
    <li class="menu-label">Dashboard</li>
    <li>
        <a href="{{ route('home') }}">
            <div class="parent-icon"><i class='bx bx-home'></i>
            </div>
            <div class="menu-title">Home</div>
        </a>
    </li>
    @if (auth()->user()->jabatan == 'admin desa' || auth()->user()->jabatan == 'admin kecamatan')
        <li class="menu-label">Master Data</li>
        <li>
            <a href="{{ route('penduduk.index') }}">
                <div class="parent-icon"><i class='bx bx-arch'></i>
                </div>
                <div class="menu-title">Penduduk</div>
            </a>
        </li>
        <li>
            <a href="{{ route('keluarga.index') }}">
                <div class="parent-icon"><i class='bx bx-id-card'></i>
                </div>
                <div class="menu-title">Keluarga</div>
            </a>
        </li>
        <li>
            <a href="{{ route('agama.index') }}">
                <div class="parent-icon"><i class='bx bx-church'></i>
                </div>
                <div class="menu-title">Agama</div>
            </a>
        </li>
        <li>
            <a href="{{ route('pekerjaan.index') }}">
                <div class="parent-icon"><i class='bx bx-cabinet'></i>
                </div>
                <div class="menu-title">Pekerjaan</div>
            </a>
        </li>
        <li>
            <a href="{{ route('kabupaten.index') }}">
                <div class="parent-icon"><i class='bx bx-dice-5'></i>
                </div>
                <div class="menu-title">Kabupaten</div>
            </a>
        </li>
        <li>
            <a href="{{ route('kecamatan.index') }}">
                <div class="parent-icon"><i class='bx bx-dice-4'></i>
                </div>
                <div class="menu-title">Kecamatan</div>
            </a>
        </li>
        <li>
            <a href="{{ route('desa.index') }}">
                <div class="parent-icon"><i class='bx bx-dice-3'></i>
                </div>
                <div class="menu-title">Desa</div>
            </a>
        </li>
    @endif
    @if (auth()->user()->jabatan != 'penduduk')
        <li class="menu-label">Pengajuan Bantuan</li>
        {{-- <li>
            <a href="{{ route('pendaftaran.index') }}">
                <div class="parent-icon"><i class='bx bx-money'></i>
                </div>
                <div class="menu-title">Pengajuan</div>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('bpnt.index') }}">
                <div class="parent-icon"><i class='bx bx-money'></i>
                </div>
                <div class="menu-title">BPNT</div>
            </a>
        </li>
        <li>
            <a href="{{ route('pkh.index') }}">
                <div class="parent-icon"><i class='bx bx-joystick-button'></i>
                </div>
                <div class="menu-title">PKH</div>
            </a>
        </li>
        <li class="menu-label">Laporan</li>
        <li>
            <a href="{{ route('report.bpnt') }}">
                <div class="parent-icon"><i class='bx bx-task'></i>
                </div>
                <div class="menu-title">BPNT</div>
            </a>
        </li>
        <li>
            <a href="{{ route('report.pkh') }}">
                <div class="parent-icon"><i class='bx bx-notification'></i>
                </div>
                <div class="menu-title">PKH</div>
            </a>
        </li>
    @endif
    @if (auth()->user()->jabatan == 'penduduk')
        <li class="menu-label">Pengajuan</li>
        <li>
            <a href="{{ route('bnpt.pendaftaran') }}">
                <div class="parent-icon"><i class='bx bx-money'></i>
                </div>
                <div class="menu-title">Pendaftaran</div>
            </a>
        </li>
    @endif
</ul>

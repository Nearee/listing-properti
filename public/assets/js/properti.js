
    (function() {
        const grid = document.getElementById('propertyGrid');
        const cards = Array.from(grid ? grid.querySelectorAll('.pf-card') : []);
        const searchInput = document.getElementById('liveSearchInput');
        const searchBtn = document.getElementById('liveSearchBtn');
        const resetBtn = document.getElementById('pfResetBtn');
        const noResultEl = document.getElementById('liveSearchNoResult');
        const resultCount = document.getElementById('pfResultCount');

        const state = {
            q: '',
            tipe: 'all',
            kasur: 'all',
            hargaMin: null,
            hargaMax: null
        };

        function applyFilters() {
            let visible = 0;

            cards.forEach(card => {
                const nama = card.dataset.nama || '';
                const tipe = card.dataset.tipe || '';
                const kasur = parseInt(card.dataset.kasur || '0', 10);
                const harga = parseInt(card.dataset.harga || '0', 10);

                const matchQ = !state.q || nama.includes(state.q) || tipe.includes(state.q);
                const matchTipe = state.tipe === 'all' || tipe === state.tipe;
                const matchKasur = state.kasur === 'all' || kasur >= parseInt(state.kasur, 10);
                const matchHarga = state.hargaMin === null ||
                    (harga >= state.hargaMin && harga <= state.hargaMax);

                const show = matchQ && matchTipe && matchKasur && matchHarga;
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            if (noResultEl) noResultEl.classList.toggle('d-none', visible !== 0);
            if (resultCount) {
                resultCount.textContent = visible === cards.length ?
                    `Menampilkan semua ${cards.length} properti` :
                    `Menampilkan ${visible} dari ${cards.length} properti`;
            }
        }

        function setActiveChip(group, btn) {
            document.querySelectorAll(`.pf-chip-row[data-group="${group}"] .pf-chip`)
                .forEach(c => c.classList.remove('is-active'));
            btn.classList.add('is-active');
        }

        document.querySelectorAll('.pf-chip-row').forEach(row => {
            row.addEventListener('click', e => {
                const btn = e.target.closest('.pf-chip');
                if (!btn) return;
                const group = row.dataset.group;
                setActiveChip(group, btn);

                if (group === 'tipe') state.tipe = btn.dataset.value;
                if (group === 'kasur') state.kasur = btn.dataset.value;
                if (group === 'harga') {
                    if (btn.dataset.value === 'all') {
                        state.hargaMin = null;
                        state.hargaMax = null;
                    } else {
                        state.hargaMin = parseInt(btn.dataset.min, 10);
                        state.hargaMax = parseInt(btn.dataset.max, 10);
                    }
                }
                applyFilters();
            });
        });

        function doSearch() {
            state.q = (searchInput.value || '').trim().toLowerCase();
            applyFilters();
        }

        if (searchInput) {
            searchInput.addEventListener('input', doSearch);
            searchInput.addEventListener('keydown', e => {
                if (e.key === 'Enter') e.preventDefault();
            });
        }
        if (searchBtn) searchBtn.addEventListener('click', doSearch);

        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                state.q = '';
                state.tipe = 'all';
                state.kasur = 'all';
                state.hargaMin = null;
                state.hargaMax = null;
                if (searchInput) searchInput.value = '';
                document.querySelectorAll('.pf-chip-row').forEach(row => {
                    row.querySelectorAll('.pf-chip').forEach(c => c.classList.remove('is-active'));
                    row.querySelector('.pf-chip[data-value="all"]')?.classList.add('is-active');
                });
                applyFilters();
            });
        }

        applyFilters();
    })();
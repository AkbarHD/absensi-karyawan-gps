  <form action="{{ route('cabang.update', $cabang->kode_cabang) }}" method="POST" id="frmCabang">
      @csrf
      @method('PUT')
      <div class="row">
          <div class="col-12">
              <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                          <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                          <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                          <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                          <path d="M5 11h1v2h-1z" />
                          <path d="M10 11l0 2" />
                          <path d="M14 11h1v2h-1z" />
                          <path d="M19 11l0 2" />
                      </svg>
                  </span>
                  <input type="text" name="kode_cabang" class="form-control" id="kode_cabang"
                      placeholder="Kode Cabang" value="{{ $cabang->kode_cabang }}">
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"
                          class="icon icon-tabler icons-tabler-outline icon-tabler-building-community">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
                          <path d="M13 7l0 .01" />
                          <path d="M17 7l0 .01" />
                          <path d="M17 11l0 .01" />
                          <path d="M17 15l0 .01" />
                      </svg>
                  </span>
                  <input type="text" name="nama_cabang" id="nama_cabang" class="form-control"
                      placeholder="Nama Cabang" value="{{ $cabang->nama_cabang }}">
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                          <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                      </svg>
                  </span>
                  <input type="text" name="lokasi_cabang" id="lokasi_cabang" class="form-control"
                      placeholder="Lokasi Cabang" value="{{ $cabang->lokasi_cabang }}">
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"
                          class="icon icon-tabler icons-tabler-outline icon-tabler-brand-flightradar24">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                          <path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                          <path d="M8.5 20l3.5 -8l-6.5 6" />
                          <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                      </svg>
                  </span>
                  <input type="number" name="radius" id="radius" class="form-control"
                      value="{{ $cabang->radius_cabang }}" placeholder="Radius">
              </div>
          </div>
      </div>

      <div class="row mt-3">
          <div class="col-12">
              <div class="form-group">
                  <button type="submit" class="btn btn-primary w-100">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"
                          class="icon icon-tabler icons-tabler-outline icon-tabler-file-download">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                          <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                          <path d="M12 17v-6" />
                          <path d="M9.5 14.5l2.5 2.5l2.5 -2.5" />
                      </svg>
                      Simpan
                  </button>
              </div>
          </div>
      </div>
  </form>

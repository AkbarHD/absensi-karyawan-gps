   @if ($histori->isEmpty())
       <div class="alert alert-warning mt-3">
           <p>Data belum ada</p>
       </div>
   @endif
   @foreach ($histori as $d)
       <ul class="listview image-listview">
           <li>
               <div class="item">
                   @php
                       $path = Storage::url('uploads/absensi/' . $d->foto_in);
                   @endphp
                   <img src="{{ url($path) }}" alt="image" class="image">
                   <div class="in">
                       <div>
                           <strong>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</strong> <br>
                       </div>
                       <span
                           class="badge {{ $d->jam_in <= '07:00' ? 'badge-success' : 'badge-danger' }}">{{ $d->jam_in }}
                       </span>
                       <span class="badge bg-primary">
                           {{ $d->jam_out ?? 'belum absen' }}
                       </span>
                   </div>
               </div>
           </li>
       </ul>
   @endforeach

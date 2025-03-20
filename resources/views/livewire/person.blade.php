<div>
    <div class="container">
        <!-- User Information-->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="user-profile me-3">
                    <img loading="lazy" src="{{auth()->user()->photo}}" alt="">
                </div>
                <div class="user-info">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                        <span class="badge bg-warning ms-2 rounded-pill"></span>
                    </div>
                    <p class="mb-0">{{session('role')}}</p>
                </div>
            </div>
        </div>

        @if(session('role') == "sales")
            <div class="card user-data-card mb-3">
                <div class="card-body">
                    <div class="direction-rtl mb-3">
                        @php
                            $status = [
                                'pending' => 'primary',
                                'process' => 'warning',
                                'success' => 'success',
                                'cancel' => 'danger',
                                'done' => 'success',
                            ];

                            $statusId = [
                                'pending' => 'Pending',
                                'process' => 'Proses',
                                'success' => 'Selesai',
                                'cancel' => 'Batal',
                                'done' => 'Selesai',
                            ];
                            $totalOrder = 0;
                        @endphp
                        <h6 id="total_order">Total Order</h6>
                        @foreach($profile['data']['status'] as $order)
                            <a style="pointer-events: none; cursor: not-allowed;" class="btn btn-{{ $status[$order['status']]}} m-1" href="#">{{ $statusId[$order['status']]}}<span class="ms-1 badge bg-{{ $status[$order['status']]}}">{{$order['total']}}</span></a>
                            @php
                                $totalOrder += $order['total'];
                            @endphp
                        @endforeach
                    </div>
                    <!-- Single Skill Progress Bar -->
                    <div class="skill-progress-bar d-flex align-items-center">
                        <!-- Skill Icon -->
                        <div class="skill-icon shadow-sm">
                            <i class="bi bi-code fz-20 text-dark"></i>
                        </div>

                        <!-- Skill Data -->
                        <div class="skill-data">
                            <!-- Skill Name-->
                            <div class="skill-name d-flex align-items-center justify-content-between">
                                <p class="mb-1">Target Penjualan :
                                    Rp. {{number_format($profile['data']['user']['target_sales'])}}</p>
                                <small
                                    class="mb-1"><span>Sedang Berjalan : Rp. {{number_format($profile['data']['order']['total'])}}
                                </small>
                            </div>
                            @php
                                $target_sales = $profile['data']['user']['target_sales'];
                                $current_sales = $profile['data']['order']['total'];
                                //item
                                $omzet_items = $profile['data']['order']['total_items'];
                                 $target_items = $profile['data']['user']['omzet_items'];

                                $percentage = ($current_sales / $target_sales) * 100;
                                $formatted_percentage = number_format($percentage, 2);

                                $percentage2 = ($omzet_items / $target_items) * 100;
                                $formatted_percentage2 = number_format($percentage2, 2);
                            @endphp
                                <!-- Progress -->
                            <div class="progress" style="height: 15px;">
                                <div class="progress-bar" style="width: {{$formatted_percentage}}%;color: #fff" role="progressbar"
                                     aria-valuenow="{{$formatted_percentage}}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">{{$formatted_percentage}}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Skill Progress Bar -->
                    <div class="skill-progress-bar d-flex align-items-center">
                        <!-- Skill Icon -->
                        <div class="skill-icon shadow-sm">
                            <i class="bi bi-bootstrap fz-20 text-primary"></i>
                        </div>

                        <!-- Skill Data -->
                        <div class="skill-data">
                            <!-- Skill Name -->
                            <div class="skill-name d-flex align-items-center justify-content-between">
                                <p class="mb-1">Target Item Terjual : {{$profile['data']['user']['omzet_items']}}</p>
                                <small
                                    class="mb-1"><span>Item Terjual : {{$omzet_items}}
                                </small>
                            </div>
                            <!-- Progress -->
                            <div class="progress" style="height: 15px;">
                                <div class="progress-bar bg-info" style="width: {{$formatted_percentage}}%;" role="progressbar" aria-valuenow="{{$formatted_percentage}}"
                                     aria-valuemin="0" aria-valuemax="100"> {{$formatted_percentage2}}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- User Meta Data-->
        <div class="card user-data-card">
            <div class="card-body">
                <form action="#">
                    <div class="form-group mb-3">
                        <label class="form-label" for="name">Nama Lengkap</label>
                        <input class="form-control" id="name" type="text" value="{{ auth()->user()->name }}"
                               placeholder="name">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="Username">Username</label>
                        <input class="form-control" id="Username" type="text" value="{{ auth()->user()->username }}"
                               placeholder="Username">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="Password">Password</label>
                        <input class="form-control" id="password" type="text"
                               placeholder="Password">
                        <small>* abaikan jika tidak merubah password</small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="address">Alamat</label>
                        <input class="form-control" id="address" type="text" value="{{ auth()->user()->address }}"
                               placeholder="address">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="phone">No Hp</label>
                        <input class="form-control" id="phone" type="text" value="{{ auth()->user()->phone }}"
                               placeholder="phone">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="photo">Foto</label>
                        <input class="form-control" id="photo" type="file" placeholder="">
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="text" value="{{ auth()->user()->email }}"
                               placeholder="Full Name" readonly="">
                    </div>

                    <button class="btn btn-success w-100" id="buttonPerson" type="button">Update Now</button>
                    <button class="btn btn-danger w-100 mt-2" id="logout" type="button">Logout</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //total_order
    @if(session('role') == "sales")
    $('#total_order').html('Total Order : ' + '{{$totalOrder}}');
    @endif
</script>

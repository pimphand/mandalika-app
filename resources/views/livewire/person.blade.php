<div>
    <div class="container">
        <!-- User Information-->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="user-profile me-3">
                    <img loading="lazy"src="{{ asset('assets/img/bg-img/2.jpg') }}" alt="">

                </div>
                <div class="user-info">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                        <span class="badge bg-warning ms-2 rounded-pill"></span>
                    </div>
                    <p class="mb-0">Sales</p>
                </div>
            </div>
        </div>

        <!-- User Meta Data-->
        <div class="card user-data-card">
            <div class="card-body">
                <form action="#">
                    <div class="form-group mb-3">
                        <label class="form-label" for="Username">Username</label>
                        <input class="form-control" id="Username" type="text" value="{{ auth()->user()->name }}"
                            placeholder="Username">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="fullname">Email</label>
                        <input class="form-control" id="fullname" type="text" value="{{ auth()->user()->email }}"
                            placeholder="Full Name" readonly="">
                    </div>

                    <button class="btn btn-success w-100" id="buttonPerson" type="button">Update Now</button>
                    <button class="btn btn-danger w-100 mt-2" id="logout" type="button">Logout</button>

                </form>
            </div>
        </div>
    </div>
</div>

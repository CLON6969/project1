@php
    $isEdit = isset($package);
@endphp

<form action="{{ $isEdit ? route('admin.web.package.update', $package) : route('admin.web.package.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    {{-- PACKAGE FIELDS --}}
    <div class="mb-3">
        <label for="package_tittle">Package Title</label>
        <input type="text" name="package_tittle" id="package_tittle" class="form-control" value="{{ old('package_tittle', $package->package_tittle ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="statement">Statement</label>
        <textarea name="statement" id="statement" class="form-control">{{ old('statement', $package->statement ?? '') }}</textarea>
    </div>

    {{-- DYNAMIC PLANS WRAPPER --}}
    <div id="plans-wrapper">
        <h4>Plans</h4>

        @if($isEdit && $package->plans)
            @foreach($package->plans as $pIndex => $plan)
                <div class="card mb-4 plan-card" data-index="{{ $pIndex }}">
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-danger float-end" onclick="removeElement(this)">Remove Plan</button>

                        <input type="hidden" name="plans[{{ $pIndex }}][id]" value="{{ $plan->id }}">

                        <div class="mb-2">
                            <label>Plan Title</label>
                            <input type="text" name="plans[{{ $pIndex }}][plan_tittle]" class="form-control" value="{{ $plan->plan_tittle }}" required>
                        </div>

                        <div class="mb-2">
                            <label>Amount</label>
                            <input type="number" name="plans[{{ $pIndex }}][amount]" class="form-control" value="{{ $plan->amount }}" required>
                        </div>

                        <div class="mb-2">
                            <label>Currency</label>
                            <input type="text" name="plans[{{ $pIndex }}][currency]" class="form-control" value="{{ $plan->currency }}" required>
                        </div>

                        <h6>Features</h6>
                        <div class="features-wrapper">
                            @foreach($plan->features as $fIndex => $feature)
                                <div class="input-group mb-2">
                                    <input type="hidden" name="plans[{{ $pIndex }}][features][{{ $fIndex }}][id]" value="{{ $feature->id }}">
                                    <input type="text" name="plans[{{ $pIndex }}][features][{{ $fIndex }}][name]" class="form-control" value="{{ $feature->name }}" required>
                                    <button type="button" class="btn btn-outline-danger" onclick="this.closest('.input-group').remove()">×</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addFeature(this)">+ Add Feature</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <button type="button" class="btn btn-secondary mb-3" onclick="addPlan()">+ Add Plan</button>

    <div class="mt-4">
        <button type="submit" class="btn btn-success">Save Package</button>
    </div>
</form>


<script>
    let planIndex = {{ $isEdit && $package->plans ? $package->plans->count() : 0 }};

    function addPlan() {
        const wrapper = document.getElementById('plans-wrapper');
        const html = `
            <div class="card mb-4 plan-card" data-index="\${planIndex}">
                <div class="card-body">
                    <button type="button" class="btn btn-sm btn-danger float-end" onclick="removeElement(this)">Remove Plan</button>

                    <div class="mb-2">
                        <label>Plan Title</label>
                        <input type="text" name="plans[\${planIndex}][plan_tittle]" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Amount</label>
                        <input type="number" name="plans[\${planIndex}][amount]" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Currency</label>
                        <input type="text" name="plans[\${planIndex}][currency]" class="form-control" required>
                    </div>

                    <h6>Features</h6>
                    <div class="features-wrapper"></div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addFeature(this)">+ Add Feature</button>
                </div>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        planIndex++;
    }

    function addFeature(button) {
        const planCard = button.closest('.plan-card');
        const planIndex = planCard.dataset.index;
        const wrapper = planCard.querySelector('.features-wrapper');
        const featureCount = wrapper.querySelectorAll('.input-group').length;

        const html = `
            <div class="input-group mb-2">
                <input type="text" name="plans[\${planIndex}][features][\${featureCount}][name]" class="form-control" placeholder="Feature name" required>
                <button type="button" class="btn btn-outline-danger" onclick="this.closest('.input-group').remove()">×</button>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
    }

    function removeElement(button) {
        button.closest('.plan-card').remove();
    }
</script>


<div>
    <form wire:submit.prevent="save">
        {{-- App Name Section --}}
        <div class="mb-4">
            <h3 class="card-title mb-3">
                <i class="ti ti-signature me-2"></i>
                Application Name
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input name="app_name" label="App Name" wire:model="app_name" required
                        placeholder="Enter application name"
                        help="This name will appear in the browser title and throughout the application" />
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="row">
            <div class="col-md-6">
                {{-- Logo Section --}}
                <div class="mb-4">
                    <h3 class="card-title mb-3">
                        <i class="ti ti-photo me-2"></i>
                        Application Logo
                    </h3>
                    <div class="mb-3">
                        <label class="form-label">Current Logo</label>
                        <div class="border rounded p-3 bg-light">
                            @if ($current_logo)
                                <img src="{{ $current_logo }}" alt="Current Logo"
                                    style="max-height: 80px; max-width: 200px;">
                            @else
                                <div class="text-muted">No logo uploaded</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload New Logo</label>
                        <input type="file" class="form-control" wire:model="logo" accept="image/*">
                        <div class="form-hint">
                            Recommended: PNG, JPG, JPEG, SVG. Max size: 2MB. Optimal dimensions: 200x60px
                        </div>
                        @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Logo Preview --}}
                    @if ($logo)
                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <div class="border rounded p-3 bg-light">
                                <img src="{{ $logo->temporaryUrl() }}" alt="Logo Preview"
                                    style="max-height: 80px; max-width: 200px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                {{-- Favicon Section --}}
                <div class="mb-4">
                    <h3 class="card-title mb-3">
                        <i class="ti ti-world me-2"></i>
                        Favicon
                    </h3>

                    <div class="mb-3">
                        <label class="form-label">Current Favicon</label>
                        <div class="border rounded p-3 bg-light d-flex align-items-center">
                            @if ($current_favicon)
                                <img src="{{ $current_favicon }}" alt="Current Favicon"
                                    style="width: 32px; height: 32px;" class="me-2">
                                <span class="text-muted">Current favicon</span>
                            @else
                                <div class="text-muted">No favicon uploaded</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload New Favicon</label>
                        <input type="file" class="form-control" wire:model="favicon" accept="image/*,.ico">
                        <div class="form-hint">
                            Recommended: ICO, PNG. Max size: 1MB. Optimal dimensions: 32x32px or 16x16px
                        </div>
                        @error('favicon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Favicon Preview --}}
                    @if ($favicon)
                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <div class="border rounded p-3 bg-light d-flex align-items-center">
                                <img src="{{ $favicon->temporaryUrl() }}" alt="Favicon Preview"
                                    style="width: 32px; height: 32px;" class="me-2">
                                <span class="text-muted">New favicon</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="card-footer border-0 bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i>
                    Save Branding Settings
                </button>
            </div>
        </div>
    </form>
</div>

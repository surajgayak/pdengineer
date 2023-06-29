<form wire:submit.prevent='updatePassword'>

    <div class="row">
        <div class="form-group col-md-6 col-12">
            <label>Old Password
                <span class="text-danger">*</span>
                @error('oldPassword')
                    <span class="font- text-danger ml-1" style="font-size: 12px;"> [
                        {{ $message }} ]</span>
                @enderror

            </label>
            <input wire:model='oldPassword' type="password" class="form-control @error('oldPassword') is-invalid @enderror">

        </div>
        <div class="form-group col-md-6 col-12">
            <label>New Password <span class="text-danger">*</span>
                @error('newPassword')
                    <span class="font- text-danger ml-1" style="font-size: 12px;"> [
                        {{ $message }} ]</span>
                @enderror
            </label>
            <input wire:model='newPassword' type="password" class="form-control @error('newPassword') @enderror">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-12">
            <label>Confirm Password <span class="text-danger">*</span>
                @error('confirmPassword')
                    <span class="font- text-danger ml-1" style="font-size: 12px;"> [
                        {{ $message }} ]</span>
                @enderror
            </label>
            <input wire:model='confirmPassword' type="password" class="form-control @error('confirmPassword') @enderror"
                value="test@example.com">

        </div>
    </div>
    <button type="submit" class="btn btn-success">Save Changes</button>
</form>

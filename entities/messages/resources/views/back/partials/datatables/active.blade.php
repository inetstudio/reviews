<input type="checkbox" name="messages[]" id="active_{{ $id }}" value="{{ $id }}" class="switchery"
       data-target="{{ route('back.reviews.messages.moderate.activity') }}" {{ ($is_active) ? 'checked' : '' }} />

<div class="row">
    <div class="col">
        <div class="article-comments">

            @include('admin.module.reviews.messages::front.form', [
                'type' => $type,
                'id' => $id,
            ])

            @include('admin.module.reviews.messages::front.list', [
                'messages' => $messages,
                'type' => $type,
                'id' => $id,
            ])

        </div>
    </div>
</div>

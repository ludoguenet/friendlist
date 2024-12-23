<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::createMergeViewWithoutDuplicates(
            'friends',
            [(new User)->sentFriendsAccepted(), (new User)->receivedFriendAccepted()]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};

<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class OrderAttachment extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'order_attachments';
    protected $guarded = [''];


    public function getVoiceAttribute($value): ?string
    {
        if (!$value) {
            return null;
        }
        return asset('storage/orders/' . $value);
    }

    public function getAttachmentFileAttribute($value): ?string
    {
        if (!$value) {
            return null;
        }
        return asset('storage/orders/' . $value);
    }
}

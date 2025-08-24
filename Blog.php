<?php
namespace app\modules\cms\models;
use Yii;
use yii\base\Model;
use app\modules\cms\helpers\Utils;
use claviska\SimpleImage;

class Blog extends Model
{


    const Image_EXT = ['jpg', 'jpeg', 'jpe', 'png', 'webp', 'bmp', 'gif'];

    const Image_UPL_DIR = 'uploads/blog/';
    public static $tablename = 'blogs';
    public static $tr_fields = ['title', 'text'];

    public static function getBlog()
    {
        $list = [];
        $where = [];
        $where = (empty($where) ? '' : ('WHERE ' . implode(" AND ", $where)));

        $joins = [];
        foreach (self::$tr_fields as $tr) {
            $joins[] = "JOIN blogs_tr $tr ON $tr.ref_id=b.id AND $tr.lang=:lang";
        }
        $joins = implode("\n", $joins);

        $columns = ["b.id", "b.image", "b.is_deleted"];
        $columns = implode(", ", $columns);


        $sqlQuery = "SELECT $columns,$tr.title,$tr.slug,$tr.text FROM " . self::$tablename . " b $joins $where AND b.is_deleted = 0  GROUP BY b.id";
        $list = Yii::$app->db->createCommand($sqlQuery, [':lang' => CMS::$default_site_lang])->queryAll();
        return $list;
    }

    public static function addBlog($post)
    {
        $sess = Yii::$app->session[Yii::$app->controller->module->id];
        $admin = $sess['user'];
        $response = ['success' => false, 'message' => 'insert_err'];
        $translates = [];


        $tr_data['title'] = trim(@(string)$post['title']);
        if (empty($tr_data['title'])) {
            $response['errors'][] = 'title_empty';
        }

        $tr_data['text'] = trim(@(string)$post['text']);
        if (empty($tr_data['text'])) {
            $response['errors'][] = 'text_empty';
        }



        // processing translates
        foreach (CMS::$site_langs as $lng) {
            foreach (self::$tr_fields as $f) {

                if (in_array($f, self::$tr_fields)) {
                    $translates[$lng][$f] = trim(@$_POST[$f][$lng]);
                }
            }
        }

        /* Image validation */
        if (!empty($_FILES['image']['name'])) {
            if (empty($_FILES['image']['error'])) {
                $blog['image'] = Utils::upload($_FILES['image']['name'], $_FILES['image']['tmp_name'], self::Image_UPL_DIR, self::Image_EXT);
                if (empty($blog['image'])) {
                    $response['errors'][] = 'image_extension_err';
                } 
            } else {
                $response['errors'][] = CMS::$upload_err[$_FILES['image']['error']];
            }
        }

        if (empty($response['errors'])) {
            $blog['is_deleted'] =0;

            $blog['add_datetime'] = (isset($_POST['publish_date'])? date('Y-m-d H:i:s', strtotime($_POST['publish_date'])): date('Y-m-d H:i:s'));
            Yii::$app->db->createCommand()->insert(self::$tablename,  $blog)->execute();
            $id = Yii::$app->db->getLastInsertID();

            if ($blog) {
                $response['success'] = true;
                $response['message'] = 'insert_suc';

                // saving translates
                foreach ($translates as $lang => $tr_data) {
                    $slug  = strtolower(str_replace(' ', '-', $tr_data['title']));
               /*     $slug = strtolower(str_replace(' ', '-', $tr_data['title']));
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
                    $slug = preg_replace('/-+/', '-', $slug);
                    $slug = trim(@(string)$slug, '-');*/

                    Yii::$app->db->createCommand()->insert('blogs_tr', [
                        'ref_id' => $id,
                        'lang' => $lang,
                        'title' => $tr_data['title'],
                        'slug' => $slug,
                        'text' => $tr_data['text'],
                    ])->execute();
                }

                // log event
                CMS::log([
                    'subj_table' => self::$tablename,
                    'subj_id' => $id,
                    'action' => 'add',
                    'descr' => 'Blogs added by ' . $admin['role'] . ' ' . $admin['name'],
                ]);
                $response['success'] = true;
                $response['message'] = 'update_suc';
            }
        }
        return $response;
    }

    public static function getBlogById($id)
    {
        $sql = "SELECT * FROM `" . self::$tablename . "` WHERE id=:id LIMIT 1";
        $model = Yii::$app->db->createCommand($sql, [':id' => $id])->queryOne();


        if (!empty($model['id'])) {
            foreach (CMS::$site_langs as $lng) {
                $data = "SELECT `title`,`slug`, `text` FROM `blogs_tr` WHERE `ref_id`=:ref_id AND `lang`=:lang";
                $params = [':ref_id' => $id, ':lang' => $lng];
                $model[$lng] = Yii::$app->db->createCommand($data, $params)->queryOne();
            }
        }

        return $model;
    }

    public static function editBlog($blog_id, $post)
    {
        $response = ['success' => false, 'message' => 'update_err'];
        $item = self::getBlogById($blog_id);

//        print_r($item);exit;
        $sess = Yii::$app->session[Yii::$app->controller->module->id];
        $admin = $sess['user'];
        if (empty($item['id'])) {
            $response['message'] = 'not_found';
            return $response;
        }

        $translates = [];
        /// processing translates
        foreach (CMS::$site_langs as $lng) {
            foreach (self::$tr_fields as $f) {
                $text = (isset($_POST[$f][$lng])) ? $_POST[$f][$lng] : "";
                $translates[$lng][$f] = $text;
            }
        }

        if (empty($response['errors'])) {
            $upd['is_deleted'] = 0;
            /* Image validation */
            if (!empty($_FILES['image']['name'])) {
                if (empty($_FILES['image']['error'])) {
                    $upd['image'] = Utils::upload($_FILES['image']['name'], $_FILES['image']['tmp_name'], self::Image_UPL_DIR, self::Image_EXT);
                    if (empty($upd['image'])) {
                        $response['errors'][] = 'image_extension_err';
                    } 
                } else {
                    $response['errors'][] = CMS::$upload_err[$_FILES['image']['error']];
                }
            }

            $date = (isset($_POST['publish_date'])? date('Y-m-d',strtotime($_POST['publish_date'])): date('Y-m-d'));
         
            $upd['add_datetime'] =  $date;
            $updated = Yii::$app->db->createCommand()->update('blogs', $upd, 'id=:id', [':id' => $blog_id])->execute();

            foreach ($translates as $lang => $tr_data) {
                $slug  = strtolower(str_replace(' ', '-', $tr_data['title']));

                $data = "SELECT `title`,`slug`, `text` FROM `blogs_tr` WHERE `ref_id`=:ref_id AND `lang`=:lang";
                $params = [':ref_id' => $blog_id, ':lang' => $lng];
                $blog_tr = Yii::$app->db->createCommand($data, $params)->queryOne();
                if (!empty($blog_tr))
                {
                    $updated = Yii::$app->db->createCommand()->update('blogs_tr', [
                        'title' => $tr_data['title'],
                        'slug' => $slug,
                        'text' => $tr_data['text'],
                    ], 'ref_id=:ref_id AND lang=:lang',
                        [
                            ':ref_id' => $blog_id,
                            ':lang' => $lang
                        ])->execute();
                }else{
                    Yii::$app->db->createCommand()->insert('blogs_tr', [
                        'ref_id' => $blog_id,
                        'lang' => $lang,
                        'title' => $tr_data['title'],
                        'slug' => $slug,
                        'text' => $tr_data['text'],
                    ])->execute();
                }

            }
            // log event
            CMS::log([
                'subj_table' => 'blocks',
                'subj_id' => $blog_id,
                'action' => 'edit',
                'descr' => 'Blogs modified by ' . $admin['role'] . ' ' . $admin['name'],
            ]);

            $response['success'] = true;
            $response['message'] = 'update_suc';
        }

        return $response;
    }

    public static function deleteBlog($blog_id)
    { // 2020-11-15

        $deleted = Yii::$app->db->createCommand()->update('blogs', [
            'is_deleted' => '1'
        ], 'id=:id', [
            ':id' => $blog_id
        ])->execute();
        if ($deleted) {
            $sess = Yii::$app->session[Yii::$app->controller->module->id];
            $admin = $sess['user'];
            CMS::log([
                'subj_table' => 'blogs',
                'subj_id' => (int)$blog_id,
                'action' => 'delete',
                'descr' => 'Blogs has been deleted by ' . $admin['role'] . ' ' . $admin['name'],
            ]);
        }

        return $deleted;
    }

    public static function getBlogLog($blog_id)
    { // 2020-11-18
        $sql = "SELECT * FROM cms_log WHERE subj_table='blogs' AND subj_id=:blog_id ORDER BY id DESC LIMIT 120";
        $params = [':blog_id' => $blog_id];
        return Yii::$app->db->createCommand($sql, $params)->queryAll();
    }
}

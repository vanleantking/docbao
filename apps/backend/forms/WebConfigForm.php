<?php

namespace Apps\Backend\Forms;
use Apps\Backend\Forms\BaseForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Apps\Backend\Models\WebConfig;

class WebConfigForm extends BaseForm {

    public function initialize(WebConfig $webConfig, $options = array())
    {
        $domain = new Text('domain', array('class'=> 'form-control', 'required' => 'required', 'placeholder' => 'google.com, vnexpress.com...'));
        $domain->addValidator(new PresenceOf(array(
            'message' => 'Domain name is required'
        )));

        $domain->setLabel('Domain Name');

        $url = new Text('url', array('class'=> 'form-control', 'required' => 'required', 'placeholder' => 'https://vnexpress.com'));

        $url->addValidator(new PresenceOf(array(
            'message' => 'URL is required'
        )));
        $url->setLabel('URL');

        $list_news = new Text('list_news', array(
            'class'=> 'form-control',
            'placeholder' => 'class to get list of news show in homepage or category'));
        $list_news->setLabel('Element Tag list news');

        $title_news = new Text('title_news', 
            array('class'=> 'form-control',
                'placeholder' => 'class to get list of title show in homepage or category'));
        $title_news->setLabel('Element Tag title news');

        $paginate_rexp = new Text('paginate_rexp',
            array('class'=> 'form-control',
                'placeholder' => 'for fetch page with pagination'));
        $paginate_rexp->setLabel('Pagination regexp');

        $homepage = new Check('homepage',
            array('class'=>'switch-button') );
        $homepage->setLabel('Is homepage');

        $content_class = new Text('content_class',
            array('class'=> 'form-control',
                'placeholder' => 'element tag to fetch content news'));
        $content_class->setLabel('Element Tag content news');

        $category_class = new Text('category_class',
            array('class'=> 'form-control',
                'placeholder' => 'element tag to fetch title news'));
        $category_class->setLabel('Element Tag category news');

        $special_header = new Check('special_header',
            array('class'=>'switch-button',
                'placeholder' => 'is domain send some special header request') );
        $special_header->setLabel('Special header');

        $meta_description = new Text('meta_description',
            array('class'=> 'form-control',
                'placeholder' => 'element tag to fetch description news'));
        $meta_description->setLabel('Meta tag description');

        $meta_keyword = new Text('meta_keyword',
            array('class'=> 'form-control',
                'placeholder' => 'element tag to fetch keywords news'));
        $meta_keyword->setLabel('Meta tag keywords');

        $category = new Text('category',
            array('class'=> 'form-control',
                'placeholder' => 'category for this url: news, hitech..'));
        $category->setLabel('Category domain');

        $meta = new Text('meta',
            array('class'=> 'form-control',
                'placeholder' => 'get other meta tags from url'));
        $meta->setLabel('Other meta tags');

        $comments_class = new Text('comments_class',
            array('class'=> 'form-control',
                'placeholder' => 'element tag for get comment on news'));
        $comments_class->setLabel('Element Tag on comment');

        $get_comment = new Check('get_comment',
            array('class'=>'switch-button') );
        $get_comment->setLabel('Get comment');

        if (isset($options['edit']) && $options['edit']) {
            $domain->setDefault($webConfig->domain);
            $url->setDefault($webConfig->url);
            $list_news->setDefault(isset($webConfig->list_news) ? $webConfig->list_news : '');
            $paginate_rexp->setDefault(isset($webConfig->paginate_rexp)? $webConfig->paginate_rexp : '');
            $content_class->setDefault(isset($webConfig->content_class)? $webConfig->content_class : '');
            $category_class->setDefault(isset($webConfig->category_class)? $webConfig->category_class : '');
            $meta_description->setDefault(isset($webConfig->meta_description)? $webConfig->meta_description : '');
            $meta_keyword->setDefault(isset($webConfig->meta_keyword)? $webConfig->meta_keyword : '');
            $category->setDefault(isset($webConfig->category)? $webConfig->category : '');
            $meta->setDefault(isset($webConfig->meta)? $webConfig->meta : '');
            $comments_class->setDefault(isset($webConfig->comments_class)? $webConfig->comments_class : '');
            $special_header = new Check('special_header', array(
                'value' => isset($webConfig->special_header) ? $webConfig->special_header : fase,
                'class' => 'switch-button'
            ));
            $special_header->setLabel('Special header');
            $homepage = new Check('homepage', array(
                'value' => isset($webConfig->homepage) ? $webConfig->homepage : false,
                'class' => 'switch-button'
            ));
            $homepage->setLabel('Is homepage');
            $get_comment = new Check('get_comment', array(
                'value' => isset($webConfig->get_comment) ? $webConfig->get_comment : false,
                'class' => 'switch-button'
            ));
            $get_comment->setLabel('Get comment');
            
        }
        $this->add($domain);
        $this->add($url);
        $this->add($list_news);
        $this->add($title_news);
        $this->add($paginate_rexp);
        $this->add($homepage);
        $this->add($content_class);
        $this->add($category_class);
        $this->add($special_header);
        $this->add($meta_description);
        $this->add($meta_keyword);
        $this->add($category);
        $this->add($meta);
        $this->add($comments_class);
        $this->add($get_comment);
    }
}

?>
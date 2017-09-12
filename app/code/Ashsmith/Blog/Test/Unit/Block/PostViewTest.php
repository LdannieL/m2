<?php namespace Ashsmith\Blog\Test\Unit\Block;

class PostViewTest extends \PHPUnit_Framework_TestCase 
{

    // public function testGetIdentities()
    // {
    //     $this->assertTrue(false);
    // }
    
    /**
     * @var \Ashsmith\Blog\Model\Post
     */
    protected $post;

    /**
     * @var \Ashsmith\Blog\Block\PostView
     */
    protected $block;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->block = $objectManager->getObject('Ashsmith\Blog\Block\PostView');
        $this->post = $objectManager->getObject('Ashsmith\Blog\Model\Post');
        $reflection = new \ReflectionClass($this->post);
        $reflectionProperty = $reflection->getProperty('_idFieldName');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->post, 'post_id');
        $this->post->setId(1);
    }


    public function testGetIdentities()
    {
        $id = 1;
        $this->block->setPost($this->post);
        $this->assertEquals(
            [\Ashsmith\Blog\Model\Post::CACHE_TAG . '_' . $id],
            $this->block->getIdentities()
        );
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->block = null;
    }
}
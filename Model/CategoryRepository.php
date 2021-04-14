<?php

namespace AHT\Product\Model;

use AHT\Product\Api\Data;
use AHT\Product\Api\CategoryRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use AHT\Product\Model\ResourceModel\Category as ResourcePost;
use AHT\Product\Model\ResourceModel\Category\CollectionFactory as PostCollectionFactory;
use AHT\Product\Api\Data\CategoryInterface;

/**
 * Class PostRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var ResourcePost
     */
    protected $resource;

    /**
     * @var PostFactory
     */
    protected $PostFactory;

    /**
     * @var PostCollectionFactory
     */
    protected $PostCollectionFactory;

    /**
     * @var Data\PostSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @param ResourcePost $resource
     * @param PostFactory $PostFactory
     * @param Data\CategoryInterfaceFactory $dataPostFactory
     * @param PostCollectionFactory $PostCollectionFactory
     * @param Data\PostSearchResultsInterfaceFactory $searchResultsFactory
     */
    private $collectionProcessor;

    public function __construct(
        ResourcePost $resource,
        CategoryFactory $PostFactory,
        Data\CategoryInterfaceFactory $dataPostFactory,
        PostCollectionFactory $PostCollectionFactory
    ) {
        $this->resource = $resource;
        $this->PostFactory = $PostFactory;
        $this->PostCollectionFactory = $PostCollectionFactory;
        // $this->searchResultsFactory = $searchResultsFactory;
        // $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Post data
     *
     * @param  \AHT\Product\Api\Data\CategoryInterface $post
     * @return \AHT\Product\Api\Data\CategoryInterface
     */
    public function save(CategoryInterface $post)
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }

        return $post;
    }

    /**
     * Load Post data by given Post Identity
     *
     * @param [type] $id
     * @return \AHT\Product\Model\ResourceModel\Category
     */
    public function getById($id)
    {
        $postId = intval($id);
        $Post = $this->PostFactory->create();
        $Post->load($postId);
        if (!$Post->getId()) {
            throw new NoSuchEntityException(__('The CMS Post with the "%1" ID doesn\'t exist.', $PostId));
        }
        $result = $Post;
        return $result;
    }

    /**
     * function get all data
     *
     * @return \AHT\Product\Api\Data\CategoryInterface
     */
    public function getList()
    {
        $collection = $this->PostCollectionFactory->create();
        return $collection->getData();
    }

    /**
     * Create post.
     *  
     * @return \AHT\Product\Api\Data\CategoryInterface
     * 
     * @throws LocalizedException
     */
    public function createPost(CategoryInterface $post)
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return json_encode(array(
            "status" => 200,
            "message" => $post->getData()
        ));
    }


    public function updatePost(String $id, CategoryInterface $post)
    {

        try {
            $objPost = $this->PostFactory->create();
            $id = intval($id);
            $objPost->setId($id);
            //Set full collum
            $objPost->setData($post->getData());
            $this->resource->save($objPost);

            return $objPost->getData();
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
    }

    public function deleteById($postId)
    {
        $id = intval($postId);
        if ($this->resource->delete($this->getById($id))) {
            return json_encode([
                "status" => 200,
                "message" => "Successfully"
            ]);
        }
    }
}
